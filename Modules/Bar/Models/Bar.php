<?php

namespace Modules\Bar\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Models\Note;

// use Modules\Bar\Database\Factories\BarFactory;

class Bar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'address', 'number', 'city',
        'psc', 'country', 'chef', 'phone',
        'multiple_products', 'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    // protected static function newFactory(): BarFactory
    // {
    //     // return BarFactory::new();
    // }
    public function notes() {
        return $this->morphMany(Note::class, 'notable')->latest();
    }
}
