<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMissingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $recipient;
    public $content;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $recipient, $content)
    {
        $this->subject = $subject;
        $this->recipient = $recipient;
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject($this->subject)
            ->subject($this->subject)
            ->view('user::emails.missing', ['recipient' => $this->recipient,'content' => $this->content]);
    }
}
