<?php

namespace App\Listeners;

use App\Events\DepositApproveEvent;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Mail\DepositApproveMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DepositApproveListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DepositApproveEvent $event): void
    {
        // Send email to user
        Mail::to($event->deposit->user->email)->send(new DepositApproveMail($event->deposit));

        // Amount
        $amount = $event->deposit->amount;

        // currency
        $currency = \App\Models\GeneralSetting::first()->currency;

        // Send a push notification to user device
        $notify = new NotificationController();
        $notify->push(
            'Deposit Request Approved! 💸',
            "Your deposit request has been approved. The amount of $amount $currency has been successfully added to your account. Thank you for using our service!",
            $event->deposit->user->fcm_token,
        );
    }
}
