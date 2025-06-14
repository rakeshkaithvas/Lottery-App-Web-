<?php

use App\Models\Lottery;
use App\Models\LotteryTicket;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;


Route::get('/test-email', function () {
    try {
        Mail::raw('Test email from Laravel.', function ($message) {
            $message->to('sureshvermaaa@gmail.com')
                    ->subject('Laravel Test Email');
        });

        return '✅ Email sent!';
    } catch (\Exception $e) {
        return '❌ Failed: ' . $e->getMessage();
    }
});

Route::get('/clear-cache', function () {
   Artisan::call('cache:clear');
   Artisan::call('route:clear');

   return "Cache cleared successfully";
});

Route::get('/run-auto-draw', function () {
    Artisan::call('auto:draw');
    return 'Auto draw command executed!';
});

Route::get('/run-storage-link', function () {
    Route::get('/linkstorage', function () {
    $targetFolder = base_path().'/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
    symlink($targetFolder, $linkFolder); 
});
});
Route::get('/test-symlink', function () {
    symlink('/home/user/public_html/storage/app/public', '/home/user/public_html/public/storage');
    return 'Symlink created';
});

Route::get('/getLotteryTickets/{id}', function ($id) {
    $tickets = LotteryTicket::where('lottery_id', $id)->with('user')->get();

    return response()->json($tickets);
});

Route::get('/getLottery/{id}', function ($id) {
    $tickets = Lottery::where('id', $id)->where('status', 'active')->first();

    return response()->json($tickets);
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});
