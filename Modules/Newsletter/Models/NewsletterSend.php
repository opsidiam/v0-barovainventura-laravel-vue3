<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Newsletter\Database\Factories\NewsletterSendFactory;

class NewsletterSend extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): NewsletterSendFactory
    // {
    //     // return NewsletterSendFactory::new();
    // }

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }
}
