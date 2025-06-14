<?php

namespace App\Listeners;

use App\Events\EmailVerificationEvent;
use App\Mail\EmailVerificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailVerificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
   /* public function handle(EmailVerificationEvent $event): void
    {
        Mail::to($event->eData['email'])->send(new EmailVerificationMail($event->eData['otp']));
    }
    */
    
   public function handle(EmailVerificationEvent $event): void
    {
        try {
            \Log::info('📨 Attempting to send email to: ' . $event->eData['email']);
    
            Mail::to($event->eData['email'])->send(new EmailVerificationMail($event->eData['otp']));
    
            \Log::info('✅ Email sent successfully to ' . $event->eData['email']);
        } catch (\Exception $e) {
            \Log::error('❌ Exception during email: ' . $e->getMessage());
        }
    }
}
