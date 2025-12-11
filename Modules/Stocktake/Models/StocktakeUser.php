<?php

namespace Modules\Stocktake\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StocktakeUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'name',
        'surname',
        'permissions',
        'password',
        'token',
        'api',
        'bar_id',
        'user_id',
        'stocktake_id',
        'mine',
    ];
}
