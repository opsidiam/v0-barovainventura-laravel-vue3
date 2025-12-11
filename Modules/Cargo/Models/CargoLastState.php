<?php

namespace Modules\Cargo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Cargo\Database\Factories\CargoLastStateFactory;

class CargoLastState extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): CargoLastStateFactory
    // {
    //     // return CargoLastStateFactory::new();
    // }
}
