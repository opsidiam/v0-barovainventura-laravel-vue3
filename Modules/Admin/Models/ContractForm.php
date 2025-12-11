<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Admin\Database\Factories\ContractFormFactory;

class ContractForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id','hash','company','name','surname','date_ico','address','city','country',
        'postal','phone','delivery_name','delivery_address','delivery_city',
        'delivery_postal','delivery_country','delivery_phone','file_id','signed',
    ];
}
