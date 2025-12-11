<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Mail\PasswordResetMail;

class CustomResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new PasswordResetMail(
            $notifiable,
            $resetUrl,
            config('auth.passwords.'.config('auth.defaults.passwords').'.expire')
        ));
    }
}
