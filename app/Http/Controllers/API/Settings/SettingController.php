<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Models\AppVersion;
use App\Models\GeneralSetting;
use App\Models\ReferSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function getSystemSetting () {
        $version = AppVersion::first();
        $response = GeneralSetting::first();
        $refer = ReferSetting::first();
        $response['email'] = Config::get('app.support_email');
        $response['phone'] = Config::get('app.support_phone');
        $response['reg'] = Config::get('logging.channels.registered.reg');
        $response['version'] = $version;
        $response['refer'] = $refer;
        return response()->json($response);
    }

   public function editProfile(Request $req)
    {
        $user = User::findOrFail(auth()->user()->id);
       
        $validatedData = $req->validate([
            'name' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6',
            'user_document' => 'sometimes|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'user_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (isset($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }

        if (isset($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        
        if ($req->filled('shop_name')) {
               $user->shop_name=$req->shop_name;
        }

          if ($req->filled('shop_category')) {
               $user->shop_category=$req->shop_category;
        }

          if ($req->filled('shop_address')) {
               $user->shop_address=$req->shop_address;
        }

          if ($req->filled('discount')) {
               $user->discount=$req->discount;
        }

         if ($req->hasFile('user_image')) {
            $file = $req->file('user_image');
            $fileName = uniqid('userimage_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('user_image'), $fileName);
            $user->user_image = 'user_image/' . $fileName;
        }

        if ($req->hasFile('shop_image')) {
            $file = $req->file('shop_image');
            $fileName = uniqid('shopimage_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('shop_image'), $fileName);
            $user->shop_image = 'shop_image/' . $fileName;
        }

        if ($req->hasFile('user_document')) {
            $file = $req->file('user_document');
            $fileName = uniqid('doc_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('user_documents'), $fileName);
            $user->user_document = 'user_documents/' . $fileName;
            $user->user_status = 'wait_for_verification';
        }

        $user->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }


    public function updateSetting ()
    {
        Config::write('logging.channels.registered.reg', true);

        return response()->json(['status' => true]);
    }
}
