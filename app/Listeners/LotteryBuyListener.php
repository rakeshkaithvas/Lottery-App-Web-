<?php

namespace App\Listeners;

use App\Events\LotteryBuyEvent;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Mail\LotteryBuyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class LotteryBuyListener
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
    public function handle(LotteryBuyEvent $event): void
    {
        // Send mail to user
        Mail::to(auth()->user()->email)->send(new LotteryBuyMail($event->lottery, $event->quantity));

        $name = $event->lottery->name;
        $qnt = $event->quantity;

        // Send a push notification to user device
        $notify = new NotificationController();
        $notify->push(
            'Lottery Tickets Purchased! 🎟️🎟️',
            "You've just purchased $qnt lottery tickets for the $name. Good luck and may the odds be ever in your favor!",
            auth()->user()->fcm_token,
        );
    }
}
