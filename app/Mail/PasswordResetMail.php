<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;
    public $user;
    public $expire;

    public function __construct($user, $resetUrl, $expire)
    {
        $this->user = $user;
        $this->resetUrl = $resetUrl;
        $this->expire = $expire;
    }

    public function build()
    {
        return $this->to($this->user->email)
        ->subject('Obnova hesla - Barová Inventúra')
            ->view('user::emails.password-reset');
    }
}
