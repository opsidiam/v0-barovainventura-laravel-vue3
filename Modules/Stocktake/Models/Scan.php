<?php

namespace Modules\Stocktake\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Models\Cargo;

// use Modules\Stocktake\Database\Factories\ScanFactory;

class Scan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'ean',
        'type',
        'update_data',
        'stocktake_user_id',
        'stocktake_id',
        'api',
        'weight',
        'full_pack',
        'add_full_pack',
        'expire',
    ];

    // protected static function newFactory(): ScanFactory
    // {
    //     // return ScanFactory::new();
    // }
    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
