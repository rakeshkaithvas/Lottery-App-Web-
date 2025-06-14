<?php

namespace App\Listeners;

use App\Events\WithdrawRequestSentEvent;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Mail\WithdrawRequestSentMail;
use App\Models\GeneralSetting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WithdrawRequestSentListener
{
    /**
     * Create the event listener.
     */
    public $setting;

    public function __construct()
    {
        $this->setting = GeneralSetting::first();
    }

    /**
     * Handle the event.
     */
    public function handle(WithdrawRequestSentEvent $event): void
    {
        // Send mail to user
        Mail::to(auth()->user()->email)->send(new WithdrawRequestSentMail($event->withdraw));

        // Send a push notification to user device
        $notify = new NotificationController();

        // amount
        $amount = $event->withdraw->amount;

        // Currency
        $currency = $this->setting->currency;

        // Format with amount and currency
        $amountWithCurrency = $amount . ' ' . $currency;

        $notify->push(
            'Withdraw Request Sent! 💸',
            "Your withdraw request has been successfully sent for processing. The requested amount of $amountWithCurrency will be transferred to your account shortly. Thank you for using our service!",
            auth()->user()->fcm_token,
        );
    }
}
