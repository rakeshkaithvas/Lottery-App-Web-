<?php

namespace App\Http\Controllers\API\Leaderboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    // public function leaderboard()
    // {
    //     $users = User::withCount([
    //         'deposits as weekly_deposits' => function ($query) {
    //             $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    //         },
    //         'withdrawals as weekly_withdrawals' => function ($query) {
    //             $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    //         },
    //         'lotteryTickets as weekly_lottery_purchases' => function ($query) {
    //             $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    //         },
    //         'lotteryTickets as weekly_lottery_wins' => function ($query) {
    //             $query->where('status', 'win')
    //                 ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    //         }
    //     ])->get();

    //     // Calculate scores
    //     $leaderboard = [];
    //     foreach ($users as $user) {
    //         $score = $user->weekly_deposits + $user->weekly_withdrawals +
    //             ($user->weekly_lottery_purchases * 0.5) + ($user->weekly_lottery_wins * 2);

    //         $leaderboard[] = [
    //             'user' => $user,
    //             'score' => $score,
    //         ];
    //     }

    //     // Sort leaderboard by score in descending order
    //     usort($leaderboard, function ($a, $b) {
    //         return $b['score'] - $a['score'];
    //     });

    //     return response()->json($leaderboard);
    // }

public function leaderboard()
{
    try {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $tickets = \App\Models\LotteryTicket::with([
            'user',
            'lottery.creator'
        ])
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->get();

        $leaderboard = [];

        foreach ($tickets as $ticket) {
            if (!$ticket->lottery || is_null($ticket->lottery->name)) {
                continue;
            }

            $userId = $ticket->user_id;

            if (!isset($leaderboard[$userId])) {
                $leaderboard[$userId] = [
                    'user_id' => $ticket->user->id,
                    'user_name' => $ticket->user->name,
                    'email' => $ticket->user->email,
                    'phone' => $ticket->user->phone,
                    'score' => 0,
                    'lottery_name' => $ticket->lottery->name,
                    'draw_date' => $ticket->lottery->draw_date,
                    'lottery_creator_name' => optional($ticket->lottery->creator)->name ?? 'Admin'
                ];
            }

            // Score from ticket
            $leaderboard[$userId]['score'] += 0.5;
            if ($ticket->status === 'win') {
                $leaderboard[$userId]['score'] += 2;
            }
        }

        // Add deposits & withdrawals for the week
        $userIds = array_keys($leaderboard);
        $users = \App\Models\User::whereIn('id', $userIds)
            ->withCount([
                'deposits as weekly_deposits' => fn($q) => $q->whereBetween('created_at', [$startOfWeek, $endOfWeek]),
                'withdrawals as weekly_withdrawals' => fn($q) => $q->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ])
            ->get()
            ->keyBy('id');

        foreach ($leaderboard as $uid => &$entry) {
            $entry['score'] += $users[$uid]->weekly_deposits ?? 0;
            $entry['score'] += $users[$uid]->weekly_withdrawals ?? 0;
        }

        // Sort descending by score
        usort($leaderboard, fn($a, $b) => $b['score'] <=> $a['score']);

        return response()->json(array_values($leaderboard));

    } catch (\Exception $e) {
        \Log::error('Leaderboard error: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong.'
        ], 500);
    }
}



// public function allTimeLeaderboard()
    // {
    //     $users = User::withCount([
    //         'deposits as total_deposits',
    //         'withdrawals as total_withdrawals',
    //         'lotteryTickets as total_lottery_purchases',
    //         'lotteryTickets as total_lottery_wins' => function ($query) {
    //             $query->where('status', 'win');
    //         }
    //     ])->get();

    //     // Calculate scores
    //     $leaderboard = [];
    //     foreach ($users as $user) {
    //         $score = $user->total_deposits + $user->total_withdrawals +
    //             ($user->total_lottery_purchases * 0.5) + ($user->total_lottery_wins * 2);

    //         $leaderboard[] = [
    //             'user' => $user,
    //             'score' => $score,
    //         ];
    //     }

    //     // Sort leaderboard by score in descending order
    //     usort($leaderboard, function ($a, $b) {
    //         return $b['score'] - $a['score'];
    //     });

    //     return response()->json($leaderboard);
    // }

public function allTimeLeaderboard()
{
    try {
        $tickets = \App\Models\LotteryTicket::with([
            'user',
            'lottery.creator'
        ])->get();

        $leaderboard = [];

        foreach ($tickets as $ticket) {
            // Skip if lottery is missing or has no name
            if (!$ticket->lottery || empty($ticket->lottery->name)) {
                continue;
            }

            $userId = $ticket->user_id;

            if (!isset($leaderboard[$userId])) {
                $leaderboard[$userId] = [
                    'user_id' => $ticket->user->id,
                    'user_name' => $ticket->user->name,
                    'email' => $ticket->user->email,
                    'phone' => $ticket->user->phone ?? null,
                    'score' => 0,
                    'lottery_name' => $ticket->lottery->name,
                    'draw_date' => $ticket->lottery->draw_date,
                    'lottery_creator_name' => optional($ticket->lottery->creator)->name ?? 'Admin',
                ];
            }

            $leaderboard[$userId]['score'] += 0.5;

            if ($ticket->status === 'win') {
                $leaderboard[$userId]['score'] += 2;
            }
        }

        // Get user deposit/withdrawal counts
        $userIds = array_keys($leaderboard);

        $users = \App\Models\User::whereIn('id', $userIds)
            ->withCount([
                'deposits as total_deposits',
                'withdrawals as total_withdrawals'
            ])
            ->get()
            ->keyBy('id');

        foreach ($leaderboard as $uid => &$entry) {
            $entry['score'] += $users[$uid]->total_deposits ?? 0;
            $entry['score'] += $users[$uid]->total_withdrawals ?? 0;
        }

        // Sort by score descending
        usort($leaderboard, fn($a, $b) => $b['score'] <=> $a['score']);

        return response()->json($leaderboard);

    } catch (\Exception $e) {
        \Log::error('All-time Leaderboard error: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong.'
        ], 500);
    }
}
    // public function monthlyLeaderboard()
    // {
    //     // Get the start and end dates for the current month
    //     $startOfMonth = now()->startOfMonth();
    //     $endOfMonth = now()->endOfMonth();

    //     $users = User::withCount([
    //         'deposits as monthly_deposits' => function ($query) use ($startOfMonth, $endOfMonth) {
    //             $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
    //         },
    //         'withdrawals as monthly_withdrawals' => function ($query) use ($startOfMonth, $endOfMonth) {
    //             $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
    //         },
    //         'lotteryTickets as monthly_lottery_purchases' => function ($query) use ($startOfMonth, $endOfMonth) {
    //             $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
    //         },
    //         'lotteryTickets as monthly_lottery_wins' => function ($query) use ($startOfMonth, $endOfMonth) {
    //             $query->where('status', 'win')
    //                 ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
    //         }
    //     ])->get();

    //     // Calculate scores
    //     $leaderboard = [];
    //     foreach ($users as $user) {
    //         $score = $user->monthly_deposits + $user->monthly_withdrawals +
    //             ($user->monthly_lottery_purchases * 0.5) + ($user->monthly_lottery_wins * 2);

    //         $leaderboard[] = [
    //             'user' => $user,
    //             'score' => $score,
    //         ];
    //     }

    //     // Sort leaderboard by score in descending order
    //     usort($leaderboard, function ($a, $b) {
    //         return $b['score'] - $a['score'];
    //     });

    //     return response()->json($leaderboard);
    // }

  public function monthlyLeaderboard()
{
    try {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Fetch all tickets for the month
        $tickets = \App\Models\LotteryTicket::with([
            'user',
            'lottery.creator'
        ])
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->get();

        $leaderboard = [];

        foreach ($tickets as $ticket) {
            if (!$ticket->lottery || is_null($ticket->lottery->name)) {
                continue;
            }

            $userId = $ticket->user_id;

            if (!isset($leaderboard[$userId])) {
                $leaderboard[$userId] = [
                    'user_id' => $ticket->user->id,
                    'user_name' => $ticket->user->name,
                    'email' => $ticket->user->email,
                    'phone' => $ticket->user->phone,
                    'score' => 0,
                    'lottery_name' => $ticket->lottery->name,
                    'draw_date' => $ticket->lottery->draw_date,
                    'lottery_creator_name' => optional($ticket->lottery->creator)->name ?? 'Admin'
                ];
            }

            $leaderboard[$userId]['score'] += 0.5;
            if ($ticket->status === 'win') {
                $leaderboard[$userId]['score'] += 2;
            }
        }

        // Get monthly deposits and withdrawals for these users
        $userIds = array_keys($leaderboard);

        $users = \App\Models\User::whereIn('id', $userIds)
            ->withCount([
                'deposits as monthly_deposits' => fn($q) => $q->whereBetween('created_at', [$startOfMonth, $endOfMonth]),
                'withdrawals as monthly_withdrawals' => fn($q) => $q->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ])
            ->get()
            ->keyBy('id');

        foreach ($leaderboard as $uid => &$entry) {
            $entry['score'] += $users[$uid]->monthly_deposits ?? 0;
            $entry['score'] += $users[$uid]->monthly_withdrawals ?? 0;
        }

        // Sort by score descending
        usort($leaderboard, fn($a, $b) => $b['score'] <=> $a['score']);

        return response()->json(array_values($leaderboard));

    } catch (\Exception $e) {
        \Log::error('Monthly Leaderboard Error: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong.'
        ], 500);
    }
 }

}
