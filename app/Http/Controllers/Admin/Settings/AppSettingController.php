<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\AppVersion;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function appVersionView ()
    {
        $data = AppVersion::first();
        return view('Admin.pages.Settings.version', ['data' => $data]);
    }

    public function updateSetting (Request $req)
    {
        $req->validate([
            'android_app_link' => 'required',
            'android_app_version' => 'required',
            'ios_app_link' => 'required',
            'ios_app_version' => 'required',
        ]);

        // Update data
        AppVersion::first()->update($req->all());

        // return
        return redirect()->back()->withSuccess('App version setting updated!');
    }
}
