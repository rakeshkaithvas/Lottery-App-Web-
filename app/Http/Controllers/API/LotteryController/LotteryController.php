<?php

namespace App\Http\Controllers\API\LotteryController;

use App\Events\LotteryBuyEvent;
use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\LotteryTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use Carbon\Carbon;

class LotteryController extends Controller
{
    public function buyLottery(Request $req)
    {
        $validatedData = $req->validate([
            'lottery_id' => 'required|exists:lotteries,id',
            'ticket_numbers' => 'required|string', // Accepts string input
        ]);

        // Convert string of ticket numbers to array
        $ticketNumbers = explode(',', $validatedData['ticket_numbers']);

        // Validate ticket numbers as an array
        $validatedTicketData = validator(['ticket_numbers' => $ticketNumbers], [
            'ticket_numbers' => 'required|array|min:1', // Ensure at least one ticket number is provided
            'ticket_numbers.*' => 'required|string|unique:lottery_tickets,ticket_number', // Ensure each ticket number is unique
        ])->validate();

        // Validate uniqueness of ticket numbers
        $uniqueTicketNumbers = array_unique($validatedTicketData['ticket_numbers']);
        if (count($validatedTicketData['ticket_numbers']) !== count($uniqueTicketNumbers)) {
            return response()->json(['error' => 'Duplicate ticket numbers are not allowed.'], 422);
        }

        // Get user
        $user = User::find(auth()->user()->id);

        // Get the lottery
        $lottery = Lottery::findOrFail($req->lottery_id);

        $soldTickets = LotteryTicket::where('lottery_id', $lottery->id)->count();

        // Check if already max lottery limit crossed
        if ($lottery->total_ticket <= $soldTickets) {
            return response()->json([
                'message' => 'Lottery ticket not available',
            ], 400);
        }

        $ticketQuantity = count($ticketNumbers);

        // Check if total lottery is smaller than total number of tickets
        if ($ticketQuantity > $lottery->total_ticket) {
            return response()->json([
                'message' => 'Max Contest Coupan count is ' . $lottery->total_ticket . '. Available Contest: ' . ($lottery->total_ticket - $soldTickets),
            ], 400);
        }

        // Get lottery total price
        $totalPrice = $lottery->price * count($ticketNumbers);

        // Check if user has sufficient balance
        if ($user->balance < $totalPrice) {
            return response()->json([
                'message' => 'You do not have sufficient balance',
            ], 400);
        }

        $user->update([
            'balance' => $user->balance - $totalPrice,
        ]);

         // Create ticket entries for each provided ticket number
        foreach ($ticketNumbers as $ticket_number) {
            LotteryTicket::create([
                'lottery_id' => $lottery->id,
                'user_id' => $user->id,
                'ticket_number' => $ticket_number
            ]);
        }

        event(new LotteryBuyEvent($lottery, $ticketQuantity));

        return response()->json([
            'message' => 'Contest ticket has been purchased!'
        ]);
    }

public function getAllLottery(Request $request)
{
    $query = Lottery::where('status', 'active')
        ->with('lotteryTickets');

    if ($request->has('created_by')) {
        $query->where('created_by', $request->created_by);
    }

    $today = \Carbon\Carbon::today();

    $lotteries = $query->get()->map(function ($lottery) use ($today) {
        $lotteryArray = $lottery->toArray();

        if (is_string($lotteryArray['winner_bonuses'])) {
            $lotteryArray['winner_bonuses'] = json_decode($lotteryArray['winner_bonuses']);
        }

        $drawDate = \Carbon\Carbon::parse($lottery->draw_date);
        $lotteryArray['draw_date'] = $drawDate->toDateTimeString();
        $lotteryArray['status_label'] = $drawDate->lt($today) ? 'Expired' : 'Live';

        return $lotteryArray;
    });

    // Sort by: today's draws first, then future, then past; each in ASC time order
    $sorted = $lotteries->sort(function ($a, $b) use ($today) {
        $aDate = \Carbon\Carbon::parse($a['draw_date']);
        $bDate = \Carbon\Carbon::parse($b['draw_date']);

        // Assign priority group
        $aGroup = $aDate->isSameDay($today) ? 0 : ($aDate->greaterThan($today) ? 1 : 2);
        $bGroup = $bDate->isSameDay($today) ? 0 : ($bDate->greaterThan($today) ? 1 : 2);

        // If different groups, sort by group
        if ($aGroup !== $bGroup) {
            return $aGroup <=> $bGroup;
        }

        // If same group, sort by actual datetime ascending
        return $aDate->timestamp <=> $bDate->timestamp;
    });

    return response()->json($sorted->values());
}


   public function getSingleLotteryPurchasedTicket ($id)
    {
        // Get lottery
        $lottery = Lottery::findOrFail($id);

        // Get auth user
        $user = auth()->user();

        // Get my applied tickets
        $tickets = LotteryTicket::where('user_id', $user->id)->where('lottery_id', $lottery->id)->with('lottery')->get();

        return response()->json($tickets);
    }

   public function getTickets()
    {
        // Get auth user
        $user = auth()->user();

        // Get my applied tickets with lottery and user relationship
        $tickets = LotteryTicket::where('user_id', $user->id)
            ->with(['lottery', 'user'])
            ->get();

        // Map the tickets to include all fields + extra fields
        $data = $tickets->map(function ($ticket) {
            $ticketArray = $ticket->toArray(); // original ticket fields

            // Add user name
            $ticketArray['winner_name'] = $ticket->user->name ?? null;

            // Add lottery name
            $ticketArray['lottery_name'] = $ticket->lottery->name ?? null;

            // Add status_label inside the lottery array
            if ($ticket->lottery) {
                $drawDate = \Carbon\Carbon::parse($ticket->lottery->draw_date);
                $ticketArray['lottery']['status_label'] = $drawDate->isPast() ? 'Expired' : 'Live';
            }

            // Remove full user data
            unset($ticketArray['user']);

            return $ticketArray;
        });

        return response()->json($data);
    }
    
    public function checkLotteryStatus($ticketNo)
    {
        // Get lottery ticket
        $ticket = LotteryTicket::where('ticket_number', $ticketNo)->with('lottery')->first();

        if (!$ticket) {
            return response()->json([
                'message' => 'No Coupan found!'
            ], 404);
        }

        return response()->json($ticket);
    }

    /* Create an API for the */
    public function apiCreateLottery(Request $req)
    {
        // Get auth user
        $user = auth()->user();
        $validator = Validator::make($req->all(), [ 
            'name' => 'required',
            'lottery_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required',
            'total_ticket' => 'required|min:1',
            'start_date' => 'required|date',
            'draw_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required',
            'total_winner' => 'required|numeric|min:1|max:' . $req->input('total_ticket'),
            'winner_bonuses' => 'required|array|size:' . $req->input('total_winner'),
            'winner_bonus_images' => 'array',
            'winner_bonus_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Save main lottery image
            $imagePath_lot = null;
            if ($req->hasFile('lottery_image')) {
                $file = $req->file('lottery_image');
                $filename = uniqid('lottery_', true) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('lottery_images'), $filename);
                $imagePath_lot = '/lottery_images/' . $filename;
            }

            // Handle winner bonuses
            $combined = [];
            $winnerImages = $req->file('winner_bonus_images');

            for ($i = 0; $i < $req->total_winner; $i++) {
                $file = $winnerImages[$i] ?? null;
                $imagePath = null;

                if ($file) {
                    $filename = uniqid('winner_', true) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('winner_bonus_images'), $filename);
                    $imagePath = '/winner_bonus_images/' . $filename;
                }

                $combined[] = [
                    'bonus' => $req->winner_bonuses[$i] ?? '',
                    'image' => $imagePath,
                ];
            }

            $lottery = Lottery::create([
                'created_by'=>$user->id,
                'name' => $req->name,
                'lottery_image' => $imagePath_lot,
                'price' => $req->price,
                'status'=>'inactive',
                'total_ticket' => $req->total_ticket,
                'start_date' => $req->start_date,
                'draw_date' => $req->draw_date,
                'type' => $req->type,
                'total_winner' => $req->total_winner,
                'winner_bonuses' => json_encode($combined),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Contest created successfully',
                'data' => $lottery
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Search  Contest API

   public function searchcontest(Request $request)
{
    $searchText = $request->input('searchcontest');

    if (!$searchText) {
        return response()->json([
            'status' => false,
            'message' => 'Search field is required'
        ], 400);
    }

    $lotteries = Lottery::where('name', 'LIKE', '%' . $searchText . '%')
        ->with('creator') // Assumes you have defined a 'creator' relationship
        ->where('status', 'active')
        ->get()
        ->map(function ($lottery) {
            // Decode winner_bonuses if it's a JSON string
            $bonuses = is_string($lottery->winner_bonuses)
                ? json_decode($lottery->winner_bonuses, true)
                : $lottery->winner_bonuses;

            if (is_array($bonuses)) {
                foreach ($bonuses as &$bonus) {
                    if (isset($bonus['image']) && !str_starts_with($bonus['image'], 'http')) {
                        $bonus['image'] = config('app.url') . $bonus['image'];
                    }
                }
            }

            $lottery->winner_bonuses = $bonuses;

            // Optionally update lottery_image as well
            if ($lottery->lottery_image && !str_starts_with($lottery->lottery_image, 'http')) {
                $lottery->lottery_image = config('app.url') . $lottery->lottery_image;
            }

            return $lottery;
        });

    return response()->json([
        'status' => true,
        'data' => $lotteries
    ]);
}


public function addContactViaQr(Request $request)
    {
        $validatedData = $request->validate([
            'qr_user_id' => 'required|exists:users,id',
            'lottery_id' => 'required|exists:lotteries,id',
            'ticket_numbers' => 'required|string', // comma-separated string
            'no_of_tickets' => 'required|integer|min:1',
        ]);

        $loggedInUser = auth()->user();

        // Can't add self
        if ($validatedData['qr_user_id'] == $loggedInUser->id) {
            return response()->json(['message' => 'You cannot add yourself as a contact.'], 400);
        }

        // Verify lottery is created by the logged-in user
        $lottery = Lottery::where('id', $validatedData['lottery_id'])
            ->where('created_by', $loggedInUser->id)
            ->first();

        if (!$lottery) {
            return response()->json(['message' => 'You are not authorized to add contacts for this contest.'], 403);
        }

        // Check if contact already added
        // $alreadyAdded = Contact::where('user_id', $loggedInUser->id)
        //     ->where('contact_id', $validatedData['qr_user_id'])
        //     ->where('lottery_id', $validatedData['lottery_id'])
        //     ->exists();

        // if ($alreadyAdded) {
        //     return response()->json(['message' => 'This user is already added as a contact for this contest.'], 409);
        // }

        // Add the contact
        Contact::create([
            'user_id' => $loggedInUser->id,
            'contact_id' => $validatedData['qr_user_id'],
            'lottery_id' => $validatedData['lottery_id'],
        ]);

        // ---- Ticket buying logic ----

        // Convert ticket_numbers to array
        $ticketNumbers = explode(',', $validatedData['ticket_numbers']);
        $ticketNumbers = array_map('trim', $ticketNumbers);

        // Validate ticket numbers are unique and not already taken
        $validatedTicketData = validator(['ticket_numbers' => $ticketNumbers], [
            'ticket_numbers' => 'required|array|min:1',
            'ticket_numbers.*' => 'required|string|unique:lottery_tickets,ticket_number',
        ])->validate();

        $uniqueTicketNumbers = array_unique($validatedTicketData['ticket_numbers']);
        if (count($ticketNumbers) !== count($uniqueTicketNumbers)) {
            return response()->json(['error' => 'Duplicate coupan numbers are not allowed.'], 422);
        }

        // Count sold tickets and calculate available
        $soldTickets = LotteryTicket::where('lottery_id', $lottery->id)->count();
        $ticketQuantity = (int) $validatedData['no_of_tickets'];
        $availableTickets = $lottery->total_ticket - $soldTickets;

        if ($availableTickets <= 0) {
            return response()->json(['message' => 'Contest Coupans are sold out.'], 400);
        }

        if ($ticketQuantity > $availableTickets) {
            return response()->json([
                'message' => 'Only ' . $availableTickets . ' Coupans are available.',
            ], 400);
        }

        // Check user balance
        // $totalPrice = $lottery->price * $ticketQuantity;
        // if ($loggedInUser->balance < $totalPrice) {
        //     return response()->json(['message' => 'Insufficient balance.'], 400);
        // }

        // Deduct user balance
        // $loggedInUser->update([
        //     'balance' => $loggedInUser->balance - $totalPrice,
        // ]);

        // Create tickets
        foreach ($ticketNumbers as $ticket_number) {
            LotteryTicket::create([
                'lottery_id' => $lottery->id,
                'user_id' => $validatedData['qr_user_id'],
                'ticket_number' => $ticket_number,
            ]);
        }

        //Update total_ticket to reflect remaining tickets
        //$lottery->total_ticket = $lottery->total_ticket - $ticketQuantity;
        $lottery->save();

        // Fire event
        event(new LotteryBuyEvent($lottery, $ticketQuantity));

        return response()->json(['message' => 'User added as contact and Contest Coupans purchased successfully.']);
    }

    
}
