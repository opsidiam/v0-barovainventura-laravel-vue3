<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Admin\Database\Factories\LeadFactory;

class Lead extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'source',
        'data',
        'status',
        'open',
        'send_mail',
        'send_lead_message',
        'send_cp',
    ];

    // protected static function newFactory(): LeadFactory
    // {
    //     // return LeadFactory::new();
    // }
}
