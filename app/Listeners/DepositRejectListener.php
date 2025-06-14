<?php

namespace App\Listeners;

use App\Events\DepositRejectEvent;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Mail\DepositRejectMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DepositRejectListener
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
    public function handle(DepositRejectEvent $event): void
    {
        // Send mail to user
        Mail::to($event->deposit->user->email)->send(new DepositRejectMail($event->deposit));


        // Amount
        $amount = $event->deposit->amount;

        // currency
        $currency = \App\Models\GeneralSetting::first()->currency;

        // reason
        $reason = $event->deposit->block_reason;

        // Send a push notification to user device
        $notify = new NotificationController();
        $notify->push(
            'Deposit Request Rejected ❌',
            "We regret to inform you that your deposit request for $amount $currency has been rejected due to $reason. If you have any questions or concerns, please feel free to contact our support team. Thank you for your understanding.",
            $event->deposit->user->fcm_token,
        );
    }
}
