<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPackages extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'parcel_id',
        'sheet_id',
        'state',
        'status',
        'data',
        'error',
        'label_url',
        'invoice_url',
        'parcel_number',
    ];


}
