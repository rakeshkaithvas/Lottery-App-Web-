<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\LotteryTicket;
use App\Models\User;
use App\Models\UserWithdraw;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function getDashboard()
    {
        $active = User::where('status', 'approved')->get()->count();

        $blocked = User::where('status', 'blocked')->get()->count();

        $unverified = User::where('otp_verified', false)->get()->count();

        $total = User::all()->count();

        $setting = GeneralSetting::first();

        $total_deposit = Deposit::sum('amount');

        $pending_deposit = Deposit::where('status', 'pending')->get()->count();

        $rejected_deposit = Deposit::where('status', 'rejected')->get()->count();

        $completed_deposit = Deposit::where('status', 'completed')->get()->count();

        $total_withdraw = Withdraw::sum('amount');

        $pending_withdraw = Withdraw::where('status', 'pending')->get()->count();

        $rejected_withdraw = Withdraw::where('status', 'rejected')->get()->count();

        $completed_withdraw = Withdraw::where('status', 'completed')->get()->count();

        $sold_ticket = LotteryTicket::all()->count();

        $tickets = LotteryTicket::with('lottery')->get();

        $sold_amount = 0;

        foreach ($tickets as $ticket) {
            $price_per_ticket = $ticket->lottery->price;

            $sold_amount += $price_per_ticket;
        }

        $total_winner = LotteryTicket::where('status', 'win')->get()->count();

        $win_amount = LotteryTicket::where('status', 'win')->sum('prize');

        return view('Admin/pages/Dashboard/dashboard', [
            'active' => $active,
            'blocked' => $blocked,
            'withdraw' => '0',
            'unverified' => $unverified,
            'total' => $total,
            'setting' => $setting,
            'total_deposit' => $total_deposit,
            'pending_deposit' => $pending_deposit,
            'rejected_deposit' => $rejected_deposit,
            'completed_deposit' => $completed_deposit,
            'total_withdraw' => $total_withdraw,
            'pending_withdraw' => $pending_withdraw,
            'rejected_withdraw' => $rejected_withdraw,
            'completed_withdraw' => $completed_withdraw,
            'sold_ticket' => $sold_ticket,
            'sold_amount' => $sold_amount,
            'total_winner' => $total_winner,
            'win_amount' => $win_amount,
        ]);
    }

    public function getPendingDeposit()
    {
        return response()->json(Deposit::all());
    }

    public function getPendingWithdraw()
    {
        return response()->json(Withdraw::all());
    }

    // In Next Update //
    // TODO:: User KYC
    // TODO:: Phone OTP
    // TODO:: Email sent to all user or single user
    // TODO:: Notification sent to single user

}
