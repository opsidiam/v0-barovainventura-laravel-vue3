<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeviceContractPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $recipient;
    public $content;
    public $pdfContent;
    public $filename;
    public $attachmentDisk;
    public $attachmentPath;
    public $attachmentName;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $recipient, $content, $attachmentDisk, $attachmentPath, $attachmentName)
    {
        $this->subject = $subject;
        $this->recipient = $recipient;
        $this->content = $content;
        $this->attachmentDisk = $attachmentDisk;
        $this->attachmentPath = $attachmentPath;
        $this->attachmentName = $attachmentName;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        $mail = $this->subject($this->subject)
            ->view('admin::emails.device-contract-pdf', [
                'recipient' => $this->recipient,
                'data' => $this->content
            ]);
        if ($this->attachmentPath) {
            $mail->attachFromStorageDisk(
                $this->attachmentDisk,
                $this->attachmentPath,
                $this->attachmentName,
                ['mime' => 'application/pdf']
            );
        }
        return $mail;
    }
}
