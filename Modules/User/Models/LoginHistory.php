<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\User\Database\Factories\LoginHistoryFactory;

class LoginHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = [
        'user_id',
        'login_time',
        'login_ip',
        'user_agent'
    ];
    protected $casts = [
        'login_time' => 'datetime'
    ];

    // protected static function newFactory(): LoginHistoryFactory
    // {
    //     // return LoginHistoryFactory::new();
    // }
}
