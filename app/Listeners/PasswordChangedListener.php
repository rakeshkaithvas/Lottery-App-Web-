<?php

namespace App\Listeners;

use App\Events\PasswordChangedEvent;
use App\Mail\PasswordChangedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PasswordChangedListener
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
    public function handle(PasswordChangedEvent $event): void
    {
        Mail::to($event->email)->send(new PasswordChangedMail());
    }
}
