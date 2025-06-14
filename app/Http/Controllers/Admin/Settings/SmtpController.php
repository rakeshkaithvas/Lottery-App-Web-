<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class SmtpController extends Controller
{
    public function showSMTPSetupForm()
    {
        return view('Admin.pages.Settings.smtp');
    }

    public function updateSMTPSettings(Request $request)
    {
        // Validate form input
        $request->validate([
            'host' => 'required|string',
            'port' => 'required|integer',
            'username' => 'required|string',
            'password' => 'required|string',
            'encryption' => 'required|string',
        ]);


        Config::write('mail.mailers.smtp.host', $request->host);
        Config::write('mail.mailers.smtp.port', $request->port);
        Config::write('mail.mailers.smtp.username', $request->username);
        Config::write('mail.mailers.smtp.password', $request->password);
        Config::write('mail.mailers.smtp.encryption', $request->encryption);


        // Clear config cache
        Artisan::call('optimize:clear');

        return redirect()->back()->with('success', 'SMTP settings updated successfully.');
    }
}
