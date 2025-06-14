<?php

namespace App\Http\Controllers\Admin\Users;

use App\Events\LoginAlertEvent;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Lottery;
use App\Models\LotteryTicket;
use App\Models\Referral;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $query = User::query();

        // Apply user_status filter if present
        if ($request->filled('user_status')) {
            $query->where('user_status', $request->user_status);
        }

        $data = $query->paginate(15);

        return view('Admin/pages/Users/users', [
            'users' => $data
        ]);
    }

    public function activeBlockUser(Request $req, $id)
    {
        // Get user
        $user = User::where('id', $id)->first();

        // check user is available
        if (!$user) {
            return back()->withErrors('No user found with this id');
        }

        // Check user state and update
        if ($user->status == 'approved') {
            // Block user
            $user->status = 'blocked';
            $user->block_reason = $req->reason;

            // Save
            $user->save();

            // Return
            return back()->withSuccess('User successfully blocked');
        } else {
            // Active user
            $user->status = 'approved';
                
            if($user->user_status == 'wait_for_verification'){
                    $user->user_status = 'verified';
            }
            // Save
            $user->save();

            // Return
            return back()->withSuccess('User successfully activated');
        }
    }

    public function deleteUser($id)
    {
        // Get user
        $user = User::where('id', $id)->first();

        // check user is available
        if (!$user) {
            return back()->withErrors('No user found with this id');
        }

        // Delete User
        User::where('id', $id)->delete();

        // return
        return back()->withSuccess('User successfully deleted');
    }

    public function userDetails ($id)
    {
        $user = User::where('id', $id)->with('referred.referrer')->first();
        $setting = GeneralSetting::first();
        $totalDeposit = Deposit::where('user_id', $user->id)->sum('amount');
        $totalWithdraw = Withdraw::where('user_id', $user->id)->sum('getable_amount');
        $totalWin = LotteryTicket::where('status', 'win')->where('user_id', $user->id)->count();
        $totalWinAmount = LotteryTicket::where('status', 'win')->where('user_id', $user->id)->sum('prize');
        $totalTicket = LotteryTicket::where('user_id', $user->id)->count();
        $totalTickets = LotteryTicket::where('user_id', $user->id)->with('lottery')->get();
        $totalRefferedUser = Referral::where('referrer_id', $user->id)->count();

        $totalTicketAmount = 0;

        foreach ($totalTickets as $ticket) {
            $totalTicketAmount += $ticket->lottery->price;
        }

        return view('Admin.pages.Users.detail',
        [
            'user' => $user,
            'setting' => $setting,
            'total_deposit' => $totalDeposit,
            'total_withdraw' => $totalWithdraw,
            'total_win' => $totalWin,
            'total_win_amount' => $totalWinAmount,
            'total_ticket' => $totalTicket,
            'total_ticket_amount' => $totalTicketAmount,
            'total_reffered_user' => $totalRefferedUser,
        ]);
    }

    public function addBalance (Request $req, $id)
    {
        User::find($id)->increment('balance', $req->amount);
        return redirect()->back()->withSuccess('Balance added');
    }

    public function removeBalance (Request $req, $id)
    {
        User::find($id)->decrement('balance', $req->amount);
        return redirect()->back()->withSuccess('Balance removed');
    }


    public function updateStatus($user_id, $status)
{
    // Validate the status manually
    if (!in_array($status, ['verified', 'rejected'])) {
        return redirect()->back()->with('error', 'Invalid status provided.');
    }

    $user = User::findOrFail($user_id);
    $user->user_status = $status;
    $user->save();

    return redirect()->back()->with('message', 'User status updated to ' . $status);
}
}
