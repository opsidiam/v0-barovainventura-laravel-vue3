<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewsletterEmail extends Mailable
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

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->subject($this->subject)
            ->view('newsletter::emails.newsletter', ['recipients' => $this->recipient,'content' => $this->content]);
    }
}
