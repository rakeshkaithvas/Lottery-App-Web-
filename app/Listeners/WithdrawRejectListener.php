<?php

namespace App\Listeners;

use App\Events\WithdrawRejectEvent;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Mail\WithdrawRejectMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WithdrawRejectListener
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
    public function handle(WithdrawRejectEvent $event): void
    {
        // Send mail to user
        Mail::to($event->withdraw->user->email)->send(new WithdrawRejectMail($event->withdraw));

        // Amount
        $amount = $event->withdraw->amount;

        // currency
        $currency = \App\Models\GeneralSetting::first()->currency;

        // reason
        $reason = $event->withdraw->block_reason;

        // Send a push notification to user device
        $notify = new NotificationController();
        $notify->push(
            'Deposit Request Rejected ❌',
            "We regret to inform you that your withdraw request for $amount $currency has been rejected due to $reason. If you have any questions or concerns, please feel free to contact our support team. Thank you for your understanding.",
            $event->withdraw->user->fcm_token,
        );
    }
}
