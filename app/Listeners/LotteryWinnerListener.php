<?php

namespace App\Listeners;

use App\Events\LotteryWinnerEvent;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Mail\EmailVerificationMail;
use App\Mail\LotteryWinnerMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class LotteryWinnerListener implements ShouldQueue
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
    public function handle(LotteryWinnerEvent $event): void
    {

        // Send email to winner
        Mail::to($event->lotteryData->user->email)->send(new LotteryWinnerMail($event->lotteryData));

        // amount
        $amount = $event->lotteryData->prize;

        // name
        $name = $event->lotteryData->lottery->name;

        // rank
        $rank = $event->lotteryData->rank;

        // ticket no
        $ticketNo = $event->lotteryData->ticket_number;

        // Send push notification to winner device
        $notify = new NotificationController();
        $notify->push(
            'Congratulations! 🎉',
            "Congratulations! You've won $amount in the $name lottery with ticket number $ticketNo! Your rank is $rank. Enjoy your winnings!",
            $event->lotteryData->user->fcm_token
        );
    }
}
