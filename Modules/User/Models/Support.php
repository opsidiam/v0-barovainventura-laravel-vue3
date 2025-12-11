<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\User\Database\Factories\SupportFactory;

class Support extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'place_problem',
        'what_problem',
        'message',
    ];
    protected $casts = [
        'created_at' => 'datetime'
    ];

    // protected static function newFactory(): SupportFactory
    // {
    //     // return SupportFactory::new();
    // }
}
