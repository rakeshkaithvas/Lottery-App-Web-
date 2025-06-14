<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\LotteryTicket;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function soldTicketLog(Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $tickets = LotteryTicket::with('user')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
            $tickets = LotteryTicket::paginate(15);
        }
        return view('Admin.pages.Reports.tickets', ['data' => $tickets]);
    }

    public function winnerLog(Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = LotteryTicket::with('user')
                ->where('status', 'win')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
            $data = LotteryTicket::where('status', 'win')->paginate(15);
        }

        return view('Admin.pages.Reports.winners', ['data' => $data]);
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
}
