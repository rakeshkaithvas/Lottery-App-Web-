<?php

namespace App\Mail;

use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\PaymentGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepositRequestSentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $deposit;
    public $gateway;
    public $setting;
    public $user;

    public function __construct(Deposit $deposit, PaymentGateway $gateway, GeneralSetting $setting)
    {
        $this->user = auth()->user();
        $this->deposit = $deposit;
        $this->gateway = $gateway;
        $this->setting = $setting;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Deposit Request Submitted Successfully',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'EmailTemplates.deposit_request_sent',
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
