<?php

namespace Modules\License\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class SendExpireLicenseEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $recipient, $content = null) {
        $this->subject = $subject;
        $this->recipient = $recipient;
        $this->data = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
            to: [
                new Address($this->recipient['email'], $this->recipient['name'])
            ],
            replyTo: [
                new Address(config('license.email.sender_email'), config('license.email.sender_name'))
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'license::emails.license-expire',
        );
    }
}
