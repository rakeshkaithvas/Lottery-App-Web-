<?php

namespace App\Http\Controllers\Admin\Withdraws;

use App\Events\WithdrawApproveEvent;
use App\Events\WithdrawRejectEvent;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function pendingWithdrawView (Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Withdraw::with('user')
                ->with('gateway')
                ->where('status', 'pending')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
        $data = Withdraw::where('status', 'pending')->with('gateway')->latest()->paginate(15);
        }
        $setting = GeneralSetting::first();
        return view('Admin.pages.Withdraws.transactions.pending', ['data' => $data, 'setting' => $setting]);
    }

    public function approvedWithdrawView (Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Withdraw::with('user')
                ->with('gateway')
                ->where('status', 'completed')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
        $data = Withdraw::where('status', 'completed')->with('gateway')->latest()->paginate(15);
        }
        $setting = GeneralSetting::first();
        return view('Admin.pages.Withdraws.transactions.approved', ['data' => $data, 'setting' => $setting]);
    }

    public function rejectedWithdrawView (Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Withdraw::with('user')
                ->with('gateway')
                ->where('status', 'rejected')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
        $data = Withdraw::where('status', 'rejected')->with('gateway')->latest()->paginate(15);
        }
        $setting = GeneralSetting::first();
        return view('Admin.pages.Withdraws.transactions.rejected', ['data' => $data, 'setting' => $setting]);
    }

    public function allWithdrawView (Request $req)
    {
        if ($req->has('email') && $req->filled('email')) {
            $desiredEmail = $req->input('email');
            $data = Withdraw::with('user')
                ->with('gateway')
                ->whereHas('user', function ($query) use ($desiredEmail) {
                    $query->where('email', $desiredEmail);
                })
                ->paginate(15);
        } else {
        $data = Withdraw::with('gateway')->latest()->paginate(15);
        }
        $setting = GeneralSetting::first();
        return view('Admin.pages.Withdraws.transactions.all', ['data' => $data, 'setting' => $setting]);
    }

    public function withdrawDetails ($id)
    {
        $withdraw = Withdraw::where('id', $id)->with('gateway')->with('fields')->first();
        $setting = GeneralSetting::first();

        return view('Admin.pages.Withdraws.transactions.details', ['withdraw' => $withdraw, 'setting' => $setting]);
    }

    public function approveWithdraw ($id)
    {

        Withdraw::findOrFail($id)->update(
            [
                'status' => 'completed',
            ],
        );

        $withdraw = Withdraw::where('id', $id)->with('gateway')->with('user')->with('fields')->first();

        // call success event
        event(new WithdrawApproveEvent($withdraw));

        // return
        return redirect()->back()->withSuccess('Withdraw request has been approved!');
    }

    public function rejectWithdraw (Request $req, $id)
    {
        $req->validate([
            'reason' => 'required',
        ]);

        Withdraw::findOrFail($id)->update(
            [
                'status' => 'rejected',
                'block_reason' => $req->reason,
            ]
        );

        $withdraw = Withdraw::where('id', $id)->with('gateway')->first();

        // call reject event
        event(new WithdrawRejectEvent($withdraw));

        // return
        return redirect()->back()->withSuccess('Withdraw request has been rejected!');
    }

}
