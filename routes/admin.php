<?php
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Deposits\DepositController;
use App\Http\Controllers\Admin\LotteryController\LotteryController;
use App\Http\Controllers\Admin\Master\MasterController;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Http\Controllers\Admin\PaymentMethod\PaymentMethodController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Admin\Settings\AppSettingController;
use App\Http\Controllers\Admin\Settings\LogoFaviconController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\Admin\Settings\SmtpController;
use App\Http\Controllers\Admin\Sliders\SlidersController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Withdraws\WithdrawController;
use App\Http\Controllers\Admin\Withdraws\WithdrawGatewayController;
use App\Http\Controllers\Admin\ScratchCard\ScratchcardController;
use Illuminate\Support\Facades\Route;

Route::middleware('should.installed')->group(function () {

Route::get('/admin/login', function () {
    return view('Admin/pages/Authentication/login');
})->name('login');


Route::post('/admin/login', [AuthController::class, 'login'])->name('request.login');

Route::middleware(['auth:admin', 'should.installed', 'demo'])->prefix('admin')->group(function () {

    // Logout Admin
    Route::get('/logout', [AuthController::class, 'logout'])->name('request.logout');

    // Admin Profile Update View
    Route::get('/update-profile-view', [AuthController::class, 'updateAdminView'])->name('update.admin.view');

    // Update Admin Email
    Route::post('/admin-email-update', [AuthController::class, 'adminEmailUpdate'])->name('admin.email.update');

    // Update Admin Password
    Route::post('/admin-password-update', [AuthController::class, 'adminPasswordUpdate'])->name('admin.password.update');

    // Dashboard
    Route::get('/', [MasterController::class, 'getDashboard'])->name('dashboard');

    // User Sections
    Route::controller(UserController::class)->prefix('users')->group(function () {

        // Get all users
        Route::get('/', 'getUsers')->name('users');

        // User Details
        Route::get('/detail/{id}', 'userDetails')->name('user.details');

        // Block or active user
        Route::post('/block-active/{id}', 'activeBlockUser')->name('active.block.user');
        Route::get('/block-active/{id}', 'activeBlockUser')->name('active.block.user');

        // Delete User
        Route::get('/delete/{id}', 'deleteUser')->name('user.delete');

        // Add Balance
        Route::post('/add-balance/{id}', 'addBalance')->name('add.balance');

        // Remove Balance
        Route::post('/remove-balance/{id}', 'removeBalance')->name('remove.balance');

        Route::get('/user/update-status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('user.status.update');
    });

     // User Scratch
    Route::controller(ScratchcardController::class)->prefix('scratchcard')->group(function () {

        // Get all users
        Route::get('/', 'getScratchcards')->name('scratchcard');

        // Toggle status (activate/deactivate)
        Route::patch('/toggle/{id}', 'toggleStatus')->name('scratchcard.toggle');

    });

    // Lottery Sections
    Route::controller(LotteryController::class)->prefix('lotteries')->group(function () {
        // Create Lottery View
        Route::get('/add', function () {
            return view('Admin.pages.Lottery.add');
        })->name('lottery.add.view');

        // Create Lottery
        Route::post('/create', 'createLottery')->name('lottery.add');

        // All Lotteries
        Route::get('/', 'getAllLottery')->name('lotteries');

        // Inactive Lotteries
        Route::get('/active-inactive/{id}', 'activeInactiveLottery')->name('active.inactive.lottery');
        Route::post('/active-inactive/{id}', 'activeInactiveLottery')->name('active.inactive.lottery');

        // Update Lottery View
        Route::get('/update-view/{id}', 'updateLotteryView')->name('update.lottery.view');

        // Update Lottery
        Route::post('/update/{id}', 'updateLottery')->name('lottery.update');

        // Manual Draw View
        Route::get('/manual-draw', 'manualDrawView')->name('manual.draw');

        // Manual Draw
        Route::get('/draw/{lotteryID}', 'manualDraw')->name('draw');

        // Auto Draw
        Route::get('/auto-draw/{lotteryID}', 'autoDraw')->name('auto.draw');

        // Purchase Statement
        Route::get('/purchased-statement', 'statementView')->name('purchase.statement');

    });

    // Deposit Sections
    Route::controller(DepositController::class)->prefix('deposits')->group(function () {
        // Pending deposits view
        Route::get('/pending', 'pendingDepositView')->name('pending.deposits');

        // Approved deposits view
        Route::get('/approved', 'approvedDepositView')->name('approved.deposits');

        // Rejected deposits view
        Route::get('/rejected', 'rejectedDepositView')->name('rejected.deposits');

        // All deposits view
        Route::get('/all', 'allDepositView')->name('all.deposits');

        // Deposit Details View
        Route::get('/deposit/{id}', 'depositDetailsView')->name('deposit.details');

        // Approve Deposit
        Route::get('/approve/{id}', 'approveDeposit')->name('approve.deposit');

        // Reject Deposit
        Route::post('/approve/{id}', 'rejectDeposit')->name('reject.deposit');
    });

    // Withdraw Gateway Sections
    Route::controller(WithdrawGatewayController::class)->prefix('withdraw-gateway')->group(function () {
        // Get withdraw gateways
        Route::get('/', 'getAllGateways')->name('withdraw.gateways');

        // Add Gateway View
        Route::get('/add', 'addGatewayView')->name('add.withdraw.gateway.view');

        // Add Gateway View
        Route::post('/add', 'addGateway')->name('add.withdraw.gateway');

        // Update Gateway view
        Route::get('/update/{id}', 'updateGetewayView')->name('update.withdraw.gateway.view');

        // Update Gateway
        Route::post('/update/{id}', 'updateGeteway')->name('update.withdraw.gateway');

        // Delete Gateway
        Route::get('/delete/{id}', 'deleteGateway')->name('delete.withdraw.gateway');

        // Active Inactive Gateway
        Route::get('/active-inactive-gateway/{id}', 'activeInactiveGateway')->name('active.inactive.withdraw.gateway');
        Route::post('/active-inactive-gateway/{id}', 'activeInactiveGateway')->name('active.inactive.withdraw.gateway');

    });

    // Withdraw Sections
    Route::controller(WithdrawController::class)->prefix('withdraws')->group(function () {
        // Get pending withdraw
        Route::get('/pending', 'pendingWithdrawView')->name('pending.withdraw');

        // Get approved withdraw
        Route::get('/approved', 'approvedWithdrawView')->name('approved.withdraw');

        // Get rejected withdraw
        Route::get('/rejected', 'rejectedWithdrawView')->name('rejected.withdraw');

        // Get all withdraw
        Route::get('/all', 'allWithdrawView')->name('all.withdraw');

        // Get all withdraw
        Route::get('/details/{id}', 'withdrawDetails')->name('withdraw.details');

        // Approve Withdraw
        Route::get('/approve/{id}', 'approveWithdraw')->name('approve.withdraw');

        // Reject Withdraw
        Route::post('/approve/{id}', 'rejectWithdraw')->name('reject.withdraw');
    });

    // Report Section
    Route::controller(ReportController::class)->prefix('reports')->group(function () {
        // Sold Ticket Log
        Route::get('/tickets', 'soldTicketLog')->name('ticket.log');

        // Winner Logs
        Route::get('winners', 'winnerLog')->name('winner.log');

        // Referral Logs
        Route::get('referrals', 'referralLog')->name('referral.log');

        // Scratch Logs
        Route::get('scracthcards', 'scratchCardLog')->name('scratch.log');

        // Wallet Transaction Logs
        Route::get('wallettransactions', 'wallettransactionsLog')->name('wallettransactions.log');
    });

    // Notification Sections
    Route::controller(NotificationController::class)->prefix('notifications')->group(function () {
        // Notification View
        Route::get('/', 'getView')->name('notification');

        // Trigger Notification
        Route::post('/trigger', 'triggerNotification')->name('trigger.notification');

        // FCM View
        Route::get('/fcm-setup', 'fcmView')->name('fcm');

        // FCM Update
        Route::post('/fcm-update', 'fcmUpdate')->name('fcm.update');
    });

    // Payment Gateways Sections
    Route::controller(PaymentMethodController::class)->prefix('gateways')->group(function () {
        // Get manual gateways gateways
        Route::get('/', 'getGateways')->name('gateways');

        // Get automatic gateways
        Route::get('/auto', 'getAutoGateways')->name('auto.gateways');

        // Add New Gateway view
        Route::get('/add', 'addGetewayView')->name('add.gateway.view');

        // Add Gateway
        Route::post('/add', 'addGateway')->name('add.gateway');

        // Update Gateway view
        Route::get('/update/{id}', 'updateGetewayView')->name('update.gateway.view');

        // Update Gateway
        Route::post('/update/{id}', 'updateGeteway')->name('update.gateway');

        // Delete Gateway
        Route::get('/delete/{id}', 'deleteGateway')->name('delete.gateway');

        // Active Inactive Gateway
        Route::get('/active-inactive-gateway/{id}', 'activeInactiveGateway')->name('active.inactive.gateway');
        Route::post('/active-inactive-gateway/{id}', 'activeInactiveGateway')->name('active.inactive.gateway');

    });

    // Sliders
    Route::controller(SlidersController::class)->prefix('sliders')->group(function () {
        // Get all sliders
        Route::get('/', 'allSliders')->name('sliders');

        // Add slider view
        Route::get('/add', 'addView')->name('add.slider.view');

        // Sdd slider
        Route::post('/add', 'addSlider')->name('add.slider');

        // Selete slider
        Route::get('/delete/{id}', 'deleteSlider')->name('delete.slider');
    });

    // Setting Sections
    Route::controller(SettingController::class)->prefix('settings')->group(function () {
        // Geneal Setting View
        Route::get('/general', 'genarelSettingView')->name('general.setting.view');

        // Refer Setting View
        Route::get('/refer', 'getReferSettingView')->name('refer.setting.view');

        // Update Refer Setting
        Route::post('/update-refer', 'updateReferSetting')->name('update.refer.setting');

        // Maintenance Setting View
        Route::get('/maintenance', 'maintenanceSettingView')->name('maintenance.setting.view');

        // Update General Setting
        Route::post('/update-general', 'updateGeneral')->name('update.general.setting');

        // Update Maintenance Setting
        Route::post('/update-maintenance', 'updateMaintenance')->name('update.maintenance.setting');
    });

    // App Version Setting
    Route::controller(AppSettingController::class)->prefix('app-version')->group(function () {
        // Get Setting
        Route::get('/', 'appVersionView')->name('app.version.setting');

        // Update Setting
        Route::post('/update', 'updateSetting')->name('update.version');
    });

    // Logo Setting
    Route::controller(LogoFaviconController::class)->prefix('logo')->group(function () {
        // Get setting view
        Route::get('/', 'logoView')->name('logo.setting');

        // Update logo
        Route::post('/update', 'update')->name('update.logo');
    });

    // SMTP Setting
    Route::controller(SmtpController::class)->prefix('smtp')->group(function () {
        // SMTP Update view
        Route::get('/', 'showSMTPsetupForm')->name('smtp.update.view');

        // SMTP Update
        Route::post('/update', 'updateSMTPSettings')->name('update.smtp');
    });
});

});
