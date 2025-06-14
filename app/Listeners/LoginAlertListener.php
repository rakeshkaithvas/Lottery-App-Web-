<?php

namespace App\Listeners;

use App\Events\LoginAlertEvent;
use App\Mail\LoginAlertMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class LoginAlertListener
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
    public function handle(LoginAlertEvent $event): void
    {
        Mail::to($event->eData['email'])->send(new LoginAlertMail($event->eData['ip']));
    }
}
