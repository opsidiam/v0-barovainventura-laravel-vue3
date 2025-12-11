<?php

namespace Modules\License\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\License\Database\Factories\LicenseFactory;

class License extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'type'
    ];

    // protected static function newFactory(): LicenseFactory
    // {
    //     // return LicenseFactory::new();
    // }
}
