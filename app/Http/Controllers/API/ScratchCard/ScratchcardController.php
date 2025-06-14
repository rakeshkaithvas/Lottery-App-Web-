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

    $user = auth()->user();

    // ✅ Check if user already has a scratch card
    $existingScratch = Scratch::where('created_by', $user->id)->first();

    if ($existingScratch) {
        return response()->json([
            'status' => 'error',
            'message' => 'You have already created a scratch card.'
        ], 403); // Forbidden
    }

    // ✅ Create new scratch card
    $scratch = Scratch::create([
        'created_by' => $user->id,
        'no_cards' => $request->no_cards,
        'gift' => $request->gift,
        'status' => 'inactive'
    ]);

    return response()->json([
        'status' => 'success',
        'data' => $scratch,
        'message' => 'Scratch card created successfully.'
    ]);
}


       public function addScanQrCode(Request $request)
        {
            $request->validate([
                'normal_user_scan_qr_id' => 'required|integer',
            ]);

            $verifiedUser = auth()->user();
            $verified_user_id = $verifiedUser->id;
            $normal_user_scan_qr_id = $request->input('normal_user_scan_qr_id');

            $scratchCards = Scratch::where('status', 'active')
                ->where('created_by', $verified_user_id)
                ->get();

            $assignedCards = [];

            foreach ($scratchCards as $scratch) {
                $existingAssignments = ScratchCardAssign::where('normal_user_scan_qr_id', $normal_user_scan_qr_id)
                    ->where('scratch_id', $scratch->id)
                    ->count();

                if ($existingAssignments >= $scratch->no_cards) {
                    continue;
                }

                $cardsToAssign = $scratch->no_cards - $existingAssignments;

                for ($i = 0; $i < $cardsToAssign; $i++) {
                    $assigned = ScratchCardAssign::create([
                        'normal_user_scan_qr_id' => $normal_user_scan_qr_id,
                        'verified_user_id' => $verified_user_id,
                        'scratch_id' => $scratch->id,
                        'status' => ($i === 0 && $existingAssignments == 0) ? 'running' : 'pending',
                    ]);

                    $assignedCards[] = $assigned;
                }
            }

            // ✅ Promote next pending card if no running exists
            foreach ($scratchCards as $scratch) {
                $hasRunning = ScratchCardAssign::where('normal_user_scan_qr_id', $normal_user_scan_qr_id)
                    ->where('scratch_id', $scratch->id)
                    ->where('status', 'running')
                    ->exists();

                if (!$hasRunning) {
                    $nextPending = ScratchCardAssign::where('normal_user_scan_qr_id', $normal_user_scan_qr_id)
                        ->where('scratch_id', $scratch->id)
                        ->where('status', 'pending')
                        ->orderBy('id')
                        ->first();

                    if ($nextPending) {
                        $nextPending->status = 'running';
                        $nextPending->save();
                    }
                }
            }

            if (count($assignedCards) > 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Scratch cards assigned successfully.',
                    'data' => $assignedCards,
                ]);
            } else {
                return response()->json([
                    'status' => 'info',
                    'message' => 'No new scratch cards to assign or all are finished.',
                ]);
            }
        }



    
    // public function getActiveScratchcards(Request $request)
    //     {
    //         $normalUserId = auth()->id();

    //         // Get all assigned scratch cards (both running and finished)
    //         $assignedScratchCards = ScratchCardAssign::where('normal_user_scan_qr_id', $normalUserId)
    //             ->whereIn('status', ['running', 'finished'])
    //             ->get();

    //         $scratchIds = $assignedScratchCards->pluck('scratch_id')->unique();

    //         // Fetch all scratch card details
    //         $scratchCards = Scratch::with('creator')
    //             ->where('status', 'active')
    //             ->whereIn('id', $scratchIds)
    //             ->orderBy('id', 'desc')
    //             ->get();

    //         $scratchCards = $scratchCards->map(function ($card) use ($normalUserId, $assignedScratchCards) {
    //             $progress = \App\Models\ScratchCardUserProgress::where('user_id', $normalUserId)
    //                 ->where('scratch_id', $card->id)
    //                 ->orderBy('scratch_date', 'desc')
    //                 ->first();

    //             $totalScratched = $progress->total_scratched ?? 0;
    //             $cardsLeft = max($card->no_cards - $totalScratched, 0);

    //             $card->cards_left = $cardsLeft;

    //             // Check if this card is assigned and finished
    //             $assignRow = $assignedScratchCards->firstWhere('scratch_id', $card->id);
    //             $card->assign_status = $assignRow->status ?? 'unknown';

    //             if ($cardsLeft === 0 && $assignRow && $assignRow->status === 'finished') {
    //                 // Last card scratched → always show with gift
    //                 $card->is_completed_with_gift = true;
    //                 $card->gift = $card->gift;
    //             } else {
    //                 // Normal behavior
    //                 $card->is_completed_with_gift = false;
    //                 unset($card->gift);
    //             }

    //             return $card;
    //         });

    //         return response()->json($scratchCards);
    //     }

 public function getActiveScratchcards(Request $request)
{
    $normalUserId = auth()->id();

    // Get all assigned scratch cards with required statuses
    $assignedScratchCards = ScratchCardAssign::where('normal_user_scan_qr_id', $normalUserId)
        ->whereIn('status', ['running', 'pending', 'finished'])
        ->orderBy('id') // ensure correct sequence
        ->get();

    $scratchCardList = [];

    // Group assigned cards by scratch_id (in case multiple assigned per scratch)
    $groupedByScratch = $assignedScratchCards->groupBy('scratch_id');

    foreach ($groupedByScratch as $scratchId => $assignments) {
        $scratch = Scratch::with('creator')
            ->where('id', $scratchId)
            ->where('status', 'active')
            ->first();

        if (!$scratch) continue;

        $progress = \App\Models\ScratchCardUserProgress::where('user_id', $normalUserId)
            ->where('scratch_id', $scratch->id)
            ->orderBy('scratch_date', 'desc')
            ->first();

        $totalScratched = $progress->total_scratched ?? 0;
        $cardsLeft = max($scratch->no_cards - $totalScratched, 0);

        foreach ($assignments as $index => $assign) {
            $show = false;
            $isLastCard = ($index === $assignments->count() - 1);

            if (in_array($assign->status, ['running', 'pending'])) {
                $show = true;
            } elseif ($assign->status === 'finished' && $isLastCard && $cardsLeft === 0) {
                $show = true;
            }

            if ($show) {
                $scratchCardList[] = [
                    'assign_id' => $assign->id,
                    'scratch_id' => $scratch->id,
                    'gift' => $scratch->gift,
                    'assign_status' => $assign->status,
                    'scratch_date' => $assign->updated_at,
                    'cards_left' => $cardsLeft,
                    'creator' => $scratch->creator,
                    'is_completed_with_gift' => ($assign->status === 'finished' && $cardsLeft === 0 && $isLastCard),
                    'gift' => ($assign->status === 'finished' && $cardsLeft === 0 && $isLastCard) ? $scratch->gift : null
                ];
            }
        }
    }

    return response()->json($scratchCardList);
}



     public function scratchCard(Request $request)
        {
            $request->validate([
                'scratch_id' => 'required|exists:scratches,id',
            ]);

            $user = auth()->user();
            $scratchId = $request->scratch_id;

            $scratch = Scratch::findOrFail($scratchId);

            // ⛔️ Check assignment is active (must be 'running')
            $assignment = ScratchCardAssign::where('normal_user_scan_qr_id', $user->id)
                ->where('scratch_id', $scratchId)
                ->where('status', 'running')
                ->first();

            if (!$assignment) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please scan the QR code again to unlock the next card.',
                ], 403);
            }

            $today = now()->toDateString();

            // Get or create today's progress
            $progress = ScratchCardUserProgress::firstOrCreate([
                'user_id' => $user->id,
                'scratch_id' => $scratchId,
                'scratch_date' => $today,
            ], [
                'scratched_today' => 0,
                'total_scratched' => 0,
            ]);

            if ($progress->total_scratched >= $scratch->no_cards) {
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

            // ✅ Set assign to finished immediately after this scratch
            $assignment->status = 'finished';
            $assignment->save();

            $cardsLeft = max($scratch->no_cards - $progress->total_scratched, 0);

            // 🎁 Final card message
            if ($cardsLeft === 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => '🎉 Congratulations! You won this gift.',
                    'total_scratched' => $progress->total_scratched,
                    'cards_left' => 0,
                    'gift' => $scratch->gift,
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

        // Get all scratch cards created by the verified user
        $scratchCards = Scratch::where('status', 'active')
            ->where('created_by', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        // Add winner info for each scratch card (only if user scratched all cards)
        $scratchCards = $scratchCards->map(function ($scratch) {
            $winners = \App\Models\ScratchCardUserProgress::where('scratch_id', $scratch->id)
                ->where('total_scratched', '>=', $scratch->no_cards)
                ->with(['user' => function ($q) {
                    $q->select('id', 'name', 'email', 'phone');
                }])
                ->get()
                ->pluck('user')
                ->filter()
                ->unique('id')
                ->values();

            $scratch->winners = $winners;
            return $scratch;
        });

        return response()->json($scratchCards);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong.',
            'error' => $e->getMessage()
        ], 500);
    }
}

        public function getscratchcard($id)
            {
                try {
                    $scratch = Scratch::where('id', $id)
                        ->where('created_by', auth()->user()->id)
                        ->firstOrFail();

                    return response()->json([
                        'status' => 'success',
                        'data' => $scratch
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Scratch card not found.',
                        'error' => $e->getMessage()
                    ], 404);
                }
            }

        public function updatescratchcard(Request $request)
            {
                $request->validate([
                    'no_cards' => 'required|integer|min:1',
                    'gift' => 'required|string|max:255',
                ]);

                $id=$request->scratch_id;

                try {
                    $scratch = Scratch::where('id', $id)
                        ->where('created_by', auth()->user()->id)
                        ->firstOrFail();

                    $scratch->update([
                        'no_cards' => $request->no_cards,
                        'gift' => $request->gift,
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'data' => $scratch,
                        'message' => 'Scratch card updated successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Scratch card not found or update failed.',
                        'error' => $e->getMessage()
                    ], 404);
                }
            }

            public function deletescratchcard($id)
{
    try {
        $userId = auth()->user()->id;

        // Find scratch card created by this user
        $scratch = Scratch::where('id', $id)
            ->where('created_by', $userId)
            ->firstOrFail();

        // Delete related assigns
        \App\Models\ScratchCardAssign::where('scratch_id', $scratch->id)->delete();

        // Delete related progress entries
        \App\Models\ScratchCardUserProgress::where('scratch_id', $scratch->id)->delete();

        // Delete the scratch card itself (or set to inactive if you prefer soft delete)
        $scratch->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Scratch card and related records deleted successfully.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Scratch card not found or delete failed.',
            'error' => $e->getMessage()
        ], 404);
    }
}

    }
