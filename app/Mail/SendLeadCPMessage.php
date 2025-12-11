<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendLeadCPMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $recipient;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $recipient)
    {
        $this->subject = $subject;
        $this->recipient = $recipient;
    }

    public function build()
    {
        return $this->subject($this->subject)
            ->subject($this->subject)
            ->view('user::emails.lead-cp-message', ['recipient' => $this->recipient]);
    }
}
