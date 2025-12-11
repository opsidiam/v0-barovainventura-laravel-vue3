<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeviceContractMail extends Mailable
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
    public function build(): self
    {
        return $this->subject($this->subject)
            ->view('admin::emails.device-contract', [
                'recipient' => $this->recipient,
                'data' => $this->content
            ]);
    }
}
