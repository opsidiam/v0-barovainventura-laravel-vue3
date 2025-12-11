<?php

namespace Modules\License\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\License\Database\Factories\OrderFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'data',
        'price',
        'month',
        'type',
        'year',
        'invoice_number',
        'invoice_id',
        'send_notification',
        'invoice_data',
        'pay_url',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected $appends = ['created_at_format'];

    // protected static function newFactory(): OrderFactory
    // {
    //     // return OrderFactory::new();
    // }

    public function getCreatedAtFormatAttribute(): string
    {
        return $this->created_at->format('d.m.Y');
    }
}
