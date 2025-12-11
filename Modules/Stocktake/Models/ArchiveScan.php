<?php

namespace Modules\Stocktake\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Stocktake\Database\Factories\ArchiveScanFactory;

class ArchiveScan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $casts = [
        'scan_data' => 'array',
        'stocktake_data' => 'array',
    ];
    // protected static function newFactory(): ArchiveScanFactory
    // {
    //     // return ArchiveScanFactory::new();
    // }
}
