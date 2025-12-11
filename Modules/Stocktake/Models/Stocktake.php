<?php

namespace Modules\Stocktake\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bar\Models\Bar;

// use Modules\Stocktake\Database\Factories\StocktakeFactory;

class Stocktake extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'user_id',
        'bar_id',
        'mine_user',
        'users',
        'api',
        'api_key',
        'send_mail',
        'password',
        'open',
        'stocktake',
    ];
    protected $casts = [
        'expire' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['name_formated','expire_formated','created_formated'];

    // protected static function newFactory(): StocktakeFactory
    // {
    //     // return StocktakeFactory::new();
    // }

    public function getNameFormatedAttribute()
    {
        $originalName = iconv('UTF-8', 'ASCII//TRANSLIT', $this->bar->name ?? '');
        $originalName .= '_'.$this->created_at->format('d-m-Y');
        $originalName = str_replace(' ', '_', $originalName);
        return ucwords(strtolower($originalName));

    }

    public function getExpireFormatedAttribute()
    {
        return $this->expire->format('d.m.Y');
    }

    public function getCreatedFormatedAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }

    public function scans()
    {
        return $this->hasMany(Scan::class,'stocktake_id');
    }

    public function bar()
    {
        return $this->belongsTo(Bar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mine_user()
    {
        return $this->belongsTo(StocktakeUser::class,'mine_user','id');
    }

    public function scan_history()
    {
        return $this->hasMany(ArchiveScan::class,'stocktake_id','id');
    }
}
