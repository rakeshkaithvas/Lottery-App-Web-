<?php
namespace App\Http\Controllers\API\ScratchCard;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Scratch;
use App\Models\ScratchCardUserProgress;
use App\Models\ScratchCardAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ScratchcardController extends Controller
{
    public function createscratchcard(Request $request)
    {
        $request->validate([
            'no_cards' => 'required|integer|min:1',
            'gift' => 'required|string|max:255',
        ]);
        
         $user = User::find(auth()->user()->id);

        $scratch = Scratch::create([
            'created_by' => $user->id,
            'no_cards' => $request->no_cards,
            'gift' => $request->gift,
            'status'=> 'inactive'
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $scratch,
            'message' => 'Scratch card created successfully.'
        ]);
    }

    public function addScanQrCode(Request $request)
    {
        // Validate input
        $request->validate([
            'normal_user_scan_qr_id' => 'required|integer',
        ]);

        $verifiedUser = auth()->user();
        $verified_user_id = $verifiedUser->id;
        $normal_user_scan_qr_id = $request->input('normal_user_scan_qr_id');

        // Get the scratch cards of the Verified User
        $scratchIds = Scratch::where('status', 'active')
            ->where('created_by', $verified_user_id)
            ->pluck('id');

        $assignedCards = [];

        if ($scratchIds->isNotEmpty()) {
            foreach ($scratchIds as $scratchId) {
                // Check if this scratch card is already assigned to this QR code
                $alreadyAssigned = ScratchCardAssign::where('normal_user_scan_qr_id', $normal_user_scan_qr_id)
                    ->where('scratch_id', $scratchId)
                    ->exists();

                if (!$alreadyAssigned) {
                    $assigned = ScratchCardAssign::create([
                        'normal_user_scan_qr_id' => $normal_user_scan_qr_id,
                        'verified_user_id' => $verified_user_id,
                        'scratch_id' => $scratchId,
                        'status' => 'running',
                    ]);

                    $assignedCards[] = $assigned;
                }
            }

            if (!empty($assignedCards)) {
                return response()->json($assignedCards);
            } else {
                return response()->json([
                    'message' => 'Scratch cards were already assigned to this QR code.'
                ], 409); // 409 Conflict
            }
        } else {
            return response()->json([
                'message' => 'No Scratch cards to assign.'
            ], 404);
        }
    }

   public function getActiveScratchcards(Request $request)
        {
            $normalUserId = auth()->id(); // Logged-in user
            // Get all scratch IDs assigned to this user
            $assignedScratchIds = ScratchCardAssign::where('normal_user_scan_qr_id', $normalUserId)
                ->where('status', 'running')
                ->pluck('scratch_id');

            // Fetch scratch cards that are active and assigned
            $scratchCards = Scratch::with('creator')
                ->where('status', 'active')
                ->whereIn('id', $assignedScratchIds)
                ->orderBy('id', 'desc')
                ->get();

            return response()->json($scratchCards);
        }


        public function scratchCard(Request $request)
        {
            $request->validate([
                'scratch_id' => 'required|exists:scratches,id',
            ]);

            $user = auth()->user();
            $scratchId = $request->scratch_id;

            $scratch = Scratch::findOrFail($scratchId);

            $today = now()->toDateString();

            // Get today's progress
            $progress = ScratchCardUserProgress::where('user_id', $user->id)
                ->where('scratch_id', $scratchId)
                ->where('scratch_date', $today)
                ->first();

            $totalScratched = $progress->total_scratched ?? 0;
            $cardsLeftBeforeScratch = max($scratch->no_cards - $totalScratched, 0);

            // Get or create today's progress record
            $progress = ScratchCardUserProgress::firstOrCreate([
                'user_id' => $user->id,
                'scratch_id' => $scratchId,
                'scratch_date' => $today,
            ], [
                'scratched_today' => 0,
                'total_scratched' => 0,
            ]);

            // Recheck total scratched after create
            if ($progress->total_scratched >= $scratch->no_cards) {

                //  Update scratch_card_assigns status to 'finished' using normal_user_scan_qr_id and scratch_id
                ScratchCardAssign::where('normal_user_scan_qr_id', $user->id)
                ->where('scratch_id', $scratchId)
                ->update(['status' => 'finished']);

                return response()->json([
                    'status' => 'done',
                    'message' => 'You have already scratched all available cards.',
                    'cards_left' => 0,
                ]);
            }

            // Scratch one card
            $progress->scratched_today += 1;
            $progress->total_scratched += 1;
            $progress->save();

            $cardsLeft = max($scratch->no_cards - $progress->total_scratched, 0);

            //  Final card scratched — show congratulatory message
            if ($cardsLeft === 0) {
                //  Update scratch_card_assigns status to 'finished' using normal_user_scan_qr_id and scratch_id
                ScratchCardAssign::where('normal_user_scan_qr_id', $user->id)
                ->where('scratch_id', $scratchId)
                ->update(['status' => 'finished']);

                return response()->json([
                    'status' => 'success',
                    'message' => '🎉 Congratulations! You won this gift.',
                    'total_scratched' => $progress->total_scratched,
                    'cards_left' => 0,
                    'gift' => $scratch->gift, //  Add this line
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Card scratched successfully!',
                'total_scratched' => $progress->total_scratched,
                'cards_left' => $cardsLeft,
            ]);
        }

    public function getUsersScratchCards(Request $request)
        {
            try {
                $user = auth()->user();

                $scratchCards = Scratch::where('status', 'active')
                    ->where('created_by', $user->id)
                    ->orderBy('id', 'desc')
                    ->get();

                return response()->json($scratchCards);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong.',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    }
