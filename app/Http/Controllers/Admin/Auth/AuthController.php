<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        $credentials = $req->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->withInput($req->except('password'));
    }

    public function updateAdminView ()
    {
        $admin = Admin::first();

        return view('Admin.pages.Authentication.update', ['admin' => $admin]);
    }

    public function adminEmailUpdate (Request $req)
    {
        // validate data
        $req->validate([
            'email' => 'required|string|email|max:255|unique:admins,email,' . auth()->user()->id,
        ]);

        // Update Data
        Admin::where('email', auth()->user()->email)->update([
            'email' => $req->email,
        ]);

        return redirect()->back()->withSuccess('Admin email has been updated');
    }

    public function adminPasswordUpdate (Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'same:new_password|required'
        ]);

        $admin = Auth::user();

        // Check if the current password matches the one stored in the database
        if (!Hash::check($request->password, $admin->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided current password does not match our records.'])->withInput();
        }

        // Update the admin's password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        Auth::logout();

        return redirect()->route('login')->withSuccess('Admin password has been updated');

    }

    // TODO:: Multi Admin add system
    // TODO:: Multi user auth system like modaretor, cashier manager, lottery manager and custom role

    public function logout()
    {
        Auth::guard('admin')->logout(); // Assuming admin guard is used
        return redirect()->route('login'); // Redirect to login page
    }
}

