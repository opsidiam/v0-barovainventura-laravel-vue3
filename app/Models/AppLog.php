<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppLog extends Model
{
    protected $fillable = [
        'user_id', 'method', 'path', 'request',
        'status', 'success', 'ip', 'user_agent',
        'error','error_trace'
    ];

    protected $casts = [
        'request' => 'array',
        'success' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
