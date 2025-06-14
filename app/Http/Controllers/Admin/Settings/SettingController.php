<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\ReferSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    public function updateGeneral(Request $req)
    {
        $req->validate([
            'user_registration' => 'required',
            'email_verification' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'title' => 'required',
        ]);


        Config::write('app.name', $req->title);
        $phone = Config::write('app.support_phone', $req->phone);
        $email = Config::write('app.support_email', $req->email);

        $data = $req->all();
        $data['maintenance_mode'] = GeneralSetting::first()->maintenance_mode;
        $data['maintenance_mode'] = GeneralSetting::first()->maintenance_mode;

        GeneralSetting::first()->update($data);

        return back()->withSuccess('Setting successfully updated');
    }

    public function updateMaintenance(Request $req)
    {
        $req->validate([
            'maintenance_mode' => 'required',
            'maintenance_message' => 'required_if:maintenance_mode,1',
        ]);

        GeneralSetting::first()->update([
            'maintenance_mode' => $req->maintenance_mode,
            'maintenance_message' => $req->maintenance_message,
        ]);

        return back()->withSuccess('Setting successfully updated');
    }

    public function genarelSettingView ()
    {
        $setting = GeneralSetting::first();
        return view('Admin.pages.Settings.general', ['setting' => $setting]);
    }

    public function getReferSettingView ()
    {
        $setting = ReferSetting::first();
        $info = GeneralSetting::first();
        return view('Admin.pages.Settings.referral', ['setting' => $setting, 'info' => $info]);
    }

    public function updateReferSetting (Request $req)
    {
        $validated = $req->validate([
            'joining_bonus' => 'required',
            'joining_bonus_amount' => 'required',
            'deposit_bonus' => 'required',
            'deposit_percentage' => 'required',
        ]);

        ReferSetting::first()->update($validated);

        return redirect()->back()->withSuccess('Refer setting has been updated');
    }

    public function maintenanceSettingView ()
    {
        $setting = GeneralSetting::first();
        return view('Admin.pages.Settings.maintenance', ['setting' => $setting]);
    }

}
