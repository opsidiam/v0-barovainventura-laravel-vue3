<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsNotifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'send_allow',
        'message',
        'send',
        'sms_id',
        'status',
        'code'
    ];
}
