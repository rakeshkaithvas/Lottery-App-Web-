<?php

namespace App\Http\Controllers\Admin\Deposits;

use App\Events\DepositApproveEvent;
use App\Events\DepositRejectEvent;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Referral;
use App\Models\ReferSetting;
use App\Models\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function pendingDepositView(Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Deposit::with('user')
                ->with('gateway')
                ->where('status', 'pending')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
            $data = Deposit::where('status', 'pending')->with('gateway')->latest()->paginate(15);
        }
        $setting = GeneralSetting::first();
        return view('Admin.pages.Deposits.pending', ['data' => $data, 'setting' => $setting]);
    }

    public function approvedDepositView(Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Deposit::with('user')
                ->with('gateway')
                ->where('status', 'completed')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
            $data = Deposit::where('status', 'completed')->with('gateway')->latest()->paginate(15);
        }
        $setting = GeneralSetting::first();
        return view('Admin.pages.Deposits.approved', ['data' => $data, 'setting' => $setting]);
    }

    public function rejectedDepositView(Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Deposit::with('user')
                ->with('gateway')
                ->where('status', 'rejected')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
            $data = Deposit::where('status', 'rejected')->with('gateway')->latest()->paginate(15);
        }
        $setting = GeneralSetting::first();
        return view('Admin.pages.Deposits.rejected', ['data' => $data, 'setting' => $setting]);
    }

    public function allDepositView(Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Deposit::with('user')
                ->with('gateway')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
            $data = Deposit::with('gateway')->latest()->paginate(15);
        }

        $setting = GeneralSetting::first();
        return view('Admin.pages.Deposits.all', ['data' => $data, 'setting' => $setting]);
    }

    public function depositDetailsView($id)
    {
        $deposit = Deposit::where('id', $id)->with('gateway')->first();

        return view('Admin.pages.Deposits.details', ['deposit' => $deposit]);
    }

    public function approveDeposit($id)
    {

        Deposit::findOrFail($id)->update(
            [
                'status' => 'completed',
            ]
        );

        $deposit = Deposit::where('id', $id)->with('gateway')->first();

        // Get refer setting
        $referSetting = ReferSetting::first();

        // Update user balance
        User::where('id', $deposit->user->id)->increment('balance', $deposit->amount);


        // Check if user is reffered by someone
        $reffered = Referral::where('referred_id', $deposit->user->id)->first();

        if (!empty($reffered)) {
            // Check if deposit bonus is enabled
            if ($referSetting->deposit_bonus) {

                // Caluclate getable bonus amount from deposit amount
                $commission = ($deposit->amount * $referSetting->deposit_percentage) / 100;

                // Add balance to reffered user
                User::where('id', $reffered->referrer_id)->increment('balance', $commission);
            }
        }

        // call success event
        event(new DepositApproveEvent($deposit));

        // return
        return redirect()->back()->withSuccess('Deposit request has been approved!');
    }

    public function rejectDeposit(Request $req, $id)
    {
        $req->validate([
            'reason' => 'required',
        ]);

        Deposit::findOrFail($id)->update(
            [
                'status' => 'rejected',
                'block_reason' => $req->reason,
            ]
        );

        $deposit = Deposit::where('id', $id)->with('gateway')->first();

        // call success event
        event(new DepositRejectEvent($deposit));

        // return
        return redirect()->back()->withSuccess('Deposit request has been rejected!');
    }
}
