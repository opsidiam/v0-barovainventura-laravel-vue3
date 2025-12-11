<?php

namespace Modules\Cargo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Cargo\Database\Factories\CargoFactory;

class Cargo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'brand',
        'type',
        'volume',
        'alcohol',
        'ean',
        'weight_full',
        'weight_empty',
        'weight_tolerance',
        'original',
        'duplicate',
        'created_by_parser',
    ];
    protected $casts = [
        'parsed_data' => 'array',
    ];

    // protected static function newFactory(): CargoFactory
    // {
    //     // return CargoFactory::new();
    // }
}
