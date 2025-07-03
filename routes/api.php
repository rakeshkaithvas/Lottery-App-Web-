<?php

use App\Http\Controllers\Admin\Master\MasterController;
use App\Http\Controllers\API\DepositController\DepositController;
use App\Http\Controllers\API\Leaderboard\LeaderboardController;
use App\Http\Controllers\API\LotteryController\LotteryController;
use App\Http\Controllers\API\Settings\SettingController;
use App\Http\Controllers\API\Sliders\SlidersController;
use App\Http\Controllers\API\Users\UserController;
use App\Http\Controllers\API\ScratchCard\ScratchcardController;
use App\Http\Controllers\API\Withdraws\WithdrawController;
use App\Http\Controllers\Install\InstallerController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware(['maintenance', 'should.installed', 'package'])->group(function () {

    // Get user data
    Route::middleware(['auth:sanctum', 'user.state'])->get('/user', function (Request $request) {
    $user = User::where('id', $request->user()->id)->first();

        if ($user && $user->user_document) {
            $user->user_document = asset('user_documents/' . $user->user_document);
        }

        if ($user && $user->user_image) {
            $user->user_image = asset($user->user_image);
        }

        if ($user->user_qr) {
        $user->user_qr = asset('user_qrcodes/' . $user->user_qr);
        }

        return $user;
    });

    // Auth Routes
    Route::controller(UserController::class)->group(function () {
        // Register
        Route::post('/register', 'register');

        // Login
        Route::post('/login', 'login');

        // Forget Password
        Route::post('/forget-password', 'forgetPassword');

        // Reset Password
        Route::post('/reset-password', 'resetPassword')->middleware('auth:sanctum');

        // LogOut User
        Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

        // OTP Verification
        Route::post('/verify-otp', [UserController::class, 'verifyOtp']);

        // Resend Verification
        Route::post('/resend-otp', [UserController::class, 'resendOtp']);

        //Send the Wallet Amount
        Route::post('/wallettransfer', [UserController::class, 'wallettransfer'])->middleware('auth:sanctum');

        //Send the Wallet Amount
        Route::post('/wallethistory', [UserController::class, 'walletHistory'])->middleware('auth:sanctum');
        
        //Send the Wallet Amount
        Route::get('/shops', [UserController::class, 'shopsusers'])->middleware('auth:sanctum');
       
        // Delete  User 
        Route::delete('/user/delete', [UserController::class, 'deleteUser'])->middleware('auth:sanctum');
    });

    // Authenticated Routes
    Route::middleware(['auth:sanctum', 'user.state'])->group(function () {

        // Settings
        Route::controller(SettingController::class)->group(function () {
            // Edit Profile
            Route::post('/edit-profile', 'editProfile');
        });

        // Refer
        Route::controller(UserController::class)->group(function () {
            Route::get('refferals', 'getReferrals');
        });

        // Sliders
        Route::controller(SlidersController::class)->group(function () {
            Route::get('/sliders', 'index');
        });

        

        // Lottery
        Route::controller(LotteryController::class)->group(function () {
            // Buy Lottery
            Route::post('/buy-lottery', 'buyLottery');

            // Create a Route  for the  COntest
         
            Route::post('/contest/create', 'apiCreateLottery');

            // Get all lottery
            Route::get('/lotteries', 'getAllLottery');

            // Get Single Lottery Purchased Ticket
            Route::get('/single-lottery-purchased-ticket/{id}', 'getSingleLotteryPurchasedTicket');

            // Get My Tickets
            Route::get('/tickets', 'getTickets');

            // Check Lottery Status
            Route::get('/lottery-status/{ticket}', 'checkLotteryStatus');

            //Search the Contest
            Route::post('/contest/search', 'searchcontest');

             //Add Contact
            Route::post('/contact', 'addContactViaQr');

            // Get all lottery
            Route::get('/listPurchased', 'listPurchased');
            
            Route::put('/update-delivery-status/{id}/{status}', 'updateDeliveryOption');

            Route::post('/update-delivery-option', 'updateDeliveryOptionByUser');

        });
        
        // ScratchCard  Controller
        Route::controller(ScratchcardController::class)->group(function () {
            // Buy Lottery
            Route::post('/create-scratch-card', 'createscratchcard');
            // get  single record
            Route::get('/scratchcards/{id}', 'getscratchcard');

            Route::post('/scratchcards/update', 'updatescratchcard');

            Route::delete('/scratchcards/delete/{id}', 'deletescratchcard');

            // Get all active scratch cards
            Route::post('/active-scratch-cards', 'getActiveScratchcards');
            // Assign
            Route::post('/assign-cards', 'addScanQrCode');

            // Scratch Card
            Route::post('/scratch-card/scratch', 'scratchCard');

            Route::get('/scratch-list', 'getUsersScratchCards');

             // Get all lottery
            Route::get('/scratchCardList', 'scratchCardList');
        });

        // Deposits
        Route::controller(DepositController::class)->group(function () {
            // Deposit Request
            Route::post('/deposit', 'createDeposit');

            // Gateways
            Route::get('/payment-gateways', 'getGateways');

            // Deposit History
            Route::get('/deposit-history', 'depositHistory');
        });

        // Withdraws
        Route::controller(WithdrawController::class)->group(function () {
            // Get available getways
            Route::get('/withdraw-gateways', 'withdrawGateways');

            // Create Withdraw
            Route::post('/withdraw', 'createWithdraw');

            // Withdraw History
            Route::get('/withdraw-history', 'withdrawHistory');
        });

        // Leaderboard
        Route::controller(LeaderboardController::class)->group(function () {
            // Get weekly leaderboard
            Route::get('/leaderboard', 'leaderboard');

            // Get alltime leaderboard
            Route::get('/alltime-leaderboard', 'allTimeLeaderboard');

            // Get monthly leaderboard
            Route::get('/monthly-leaderboard', 'monthlyLeaderboard');
        });
    });
});

Route::prefix('v1')->group(function () {
    // Settings Routes
    Route::controller(SettingController::class)->group(function () {
        // Get System Setting
        Route::get('/system-setting', 'getSystemSetting');

        // Update Setting
        Route::post('/update', 'updateSetting')->middleware(['should.installed', 'package']);
    });
});


// For admin
Route::controller(MasterController::class)->group(function () {
    Route::get('/getPendingDeposit', 'getPendingDeposit');
    Route::get('/getPendingWithdraw', 'getPendingWithdraw');
});


// For admin
Route::post('/v1/author/regi', function (Request $req) {
    if (!empty($req->android)) {
        Config::write('logging.channels.registered.android', $req->android);
    }

    if (!empty($req->ios)) {
        Config::write('logging.channels.registered.ios', $req->ios);
    }

    return response()->json([
        'message' => 'Request success',
        'android' => config('logging.channels.registered.android'),
        'ios' => config('logging.channels.registered.ios'),
    ]);
});




