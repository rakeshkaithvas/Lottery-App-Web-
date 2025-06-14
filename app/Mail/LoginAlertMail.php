<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Queue;
use Stevebauman\Location\Facades\Location;

class LoginAlertMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $location;
    public $ip;

    /**
     * Create a new message instance.
     */
    public function __construct($ip)
    {
        $this->ip = $ip;

        $location = Location::get($ip);

        $this->location = $location;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Unusual Login Alert',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'EmailTemplates.login_alerts',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
