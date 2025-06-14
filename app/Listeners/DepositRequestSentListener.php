<?php

namespace App\Listeners;

use App\Events\DepositRequestSentEvent;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Mail\DepositRequestSentMail;
use App\Models\GeneralSetting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DepositRequestSentListener
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
    public function handle(DepositRequestSentEvent $event): void
    {
        // Send mail to user when user sent a deposit request
        Mail::to(auth()->user()->email)->send(new DepositRequestSentMail($event->deposit, $event->gateway, $this->setting));

        // Send a push notification to user device
        $notify = new NotificationController();
        $notify->push(
            'Deposit Request Submitted',
            'Your deposit request of ' . $event->deposit->amount . ' ' . $this->setting->currency . ' via ' . $event->deposit->gateway_name . ' has been submitted successfully.',
            auth()->user()->fcm_token,
        );
    }
}
