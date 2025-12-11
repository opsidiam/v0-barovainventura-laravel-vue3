<?php

namespace Modules\Stocktake\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StocktakePdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $recipient;
    public $content;
    public $pdfContent;
    public $filename;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $recipient, $content, $pdfContent, $filename)
    {
        $this->subject = $subject;
        $this->recipient = $recipient;
        $this->content = $content;
        $this->pdfContent = $pdfContent;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject($this->subject)
            ->view('stocktake::emails.close-stocktake', [
                'recipient' => $this->recipient,
                'data' => $this->content
            ])
            ->attachData($this->pdfContent, $this->filename, [
                'mime' => 'application/pdf',
            ]);
    }
}
