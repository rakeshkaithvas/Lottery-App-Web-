<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\LotteryTicket;
use App\Models\Referral;
use App\Models\Scratch;
use App\Models\User;
use App\Models\ScratchCardAssign;
use App\Models\ScratchCardUserProgress;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;

class ReportController extends Controller
{
    public function soldTicketLog(Request $req)
    {
        $tickets = LotteryTicket::with(['user', 'lottery']);

        if ($req->filled('email')) {
            $tickets->whereHas('user', function ($query) use ($req) {
                $query->where('email', $req->input('email'));
            });
        }

        if ($req->filled('lottery_id')) {
            $tickets->where('lottery_id', $req->input('lottery_id'));
        }

        $data = $tickets->latest()->paginate(15);
        $lotteries = Lottery::select('id', 'name')->orderBy('name')->get();

        return view('Admin.pages.Reports.tickets', compact('data', 'lotteries'));
    }

   public function winnerLog(Request $req)
    {
        $query = LotteryTicket::with(['user', 'lottery'])->where('status', 'win');

        // Filter by email
        if ($req->filled('email')) {
            $query->whereHas('user', function ($q) use ($req) {
                $q->where('email', $req->email);
            });
        }

        // Filter by lottery
        if ($req->filled('lottery_id')) {
            $query->where('lottery_id', $req->lottery_id);
        }

        $data = $query->paginate(15);
        $lotteries = Lottery::all(); // For dropdown

        return view('Admin.pages.Reports.winners', compact('data', 'lotteries'));
    }

    public function referralLog(Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Referral::with('referrer')
                ->whereHas('referrer', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
            $data = Referral::with('refferer')->with('referrer')->paginate(15);
        }
        return view('Admin.pages.Reports.refer', ['data' => $data]);
    }

   public function scratchCardLog(Request $request)
    {
        $query = ScratchCardAssign::with([
            'scratch.creator', // also load the creator of the scratch card
            'user',
            'progress'
        ]);

        // Filter by assigned user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by scratch card
        if ($request->filled('scratch_id')) {
            $query->where('scratch_id', $request->scratch_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by creator (from scratches table)
        if ($request->filled('created_by')) {
            $query->whereHas('scratch', function ($q) use ($request) {
                $q->where('created_by', $request->created_by);
            });
        }

        $data = $query->latest()->paginate(20);

        // Also fetch users to populate dropdowns
        $users1 = User::select('id', 'name')->get();

        return view('Admin.pages.Reports.scratch', compact('data', 'users1'));
    }

    public function wallettransactionsLog(Request $request)
     {
        $query = WalletTransaction::with(['sender:id,name,email,phone', 'receiver:id,name,email,phone'])
                    ->orderBy('created_at', 'desc');
        // Optional search by sender or receiver name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('sender', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                })->orWhereHas('receiver', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                });
        }
        $data = $query->paginate(20);
        return view('Admin.pages.Reports.wallet', compact('data'));
        }
}
