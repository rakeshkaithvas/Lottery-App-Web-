<?php

namespace App\Listeners;

use App\Events\WithdrawApproveEvent;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Mail\WithdrawApproveMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WithdrawApproveListener
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
    public function handle(WithdrawApproveEvent $event): void
    {
        // Send mail to user
        Mail::to($event->withdraw->user->email)->send(new WithdrawApproveMail($event->withdraw));

        // currency
        $currency = \App\Models\GeneralSetting::first()->currency;

        // amount
        $amount = $event->withdraw->amount;

        // Local Amount
        $localAmount = $event->withdraw->getable_amount . ' ' . $event->withdraw->gateway->currency;

        // Send a push notification to user device
        $notify = new NotificationController();
        $notify->push(
            'Withdraw Request Approved! 💸',
            "Your withdraw request has been approved. The amount of $amount $currency ($localAmount) has been successfully added to your account. Thank you for using our service!",
            $event->withdraw->user->fcm_token,
        );
    }
}
