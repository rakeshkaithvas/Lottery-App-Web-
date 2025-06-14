<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\LogoFaviconSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoFaviconController extends Controller
{
    public function logoView () {
        $setting = LogoFaviconSetting::first();

        return view('Admin.pages.Settings.logo', ['data' => $setting]);
    }



    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if logo is being updated
        if ($request->hasFile('logo')) {
            $this->updateLogo($request);
        }

        // Check if favicon is being updated
        if ($request->hasFile('fav_icon')) {
            $this->updateFavicon($request);
        }

        return redirect()->back()->with('success', 'Logo and Favicon updated successfully');
    }

    private function updateLogo(Request $request)
    {
        // Delete the old logo file
        $oldLogoPath = LogoFaviconSetting::value('logo');
        if ($oldLogoPath && Storage::disk('public')->exists($oldLogoPath)) {
            Storage::disk('public')->delete($oldLogoPath);
        }

        // Store the new logo
        $newLogoPath = $request->file('logo')->storeAs('logo', 'logo.png', 'public');

        $logo = Storage::url($newLogoPath);

        // Update the logo path in the database
        LogoFaviconSetting::first()->update(['logo' => $logo]);
    }

    private function updateFavicon(Request $request)
    {
        // Delete the old favicon file
        $oldFaviconPath = LogoFaviconSetting::value('fav_icon');
        if ($oldFaviconPath && Storage::disk('public')->exists($oldFaviconPath)) {
            Storage::disk('public')->delete($oldFaviconPath);
        }

        // Store the new favicon
        $newFaviconPath = $request->file('fav_icon')->storeAs('logo', 'favicon.png', 'public');

        $favicon = Storage::url($newFaviconPath);

        // Update the favicon path in the database
        LogoFaviconSetting::first()->update(['fav_icon' => $favicon]);
    }
}
