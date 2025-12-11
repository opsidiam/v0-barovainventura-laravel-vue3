<?php

namespace Modules\Item\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Models\Cargo;

// use Modules\Item\Database\Factories\ItemFactory;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'last_stocktake',
        'weight_previous',
        'cargo_id',
        'bar_id',
        'user_id',
        'type',
        'weight_last_stocktake',
        'weight_count',
        'full_pack_last_stocktake',
        'full_pack_count',
    ];

    // protected static function newFactory(): ItemFactory
    // {
    //     // return ItemFactory::new();
    // }

    public function cargo()
    {
        return $this->hasOne(Cargo::class,'id','cargo_id');
    }
}
