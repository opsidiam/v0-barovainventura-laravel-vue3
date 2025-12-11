<?php

namespace Modules\Newsletter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Newsletter\Database\Factories\NewsletterFactory;

class Newsletter extends Model
{
    use HasFactory;

    protected $appends = ['created_formated'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['subject', 'message', 'sending_done'];

    // protected static function newFactory(): NewsletterFactory
    // {
    //     // return NewsletterFactory::new();
    // }

    public function getCreatedFormatedAttribute()
    {
        return $this->created_at->format('d.m.Y H:i');
    }
}
