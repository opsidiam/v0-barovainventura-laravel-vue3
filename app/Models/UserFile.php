<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Note;

class UserFile extends Model
{
    protected $fillable = [
        'user_id', 'original_name', 'disk', 'path', 'type', 'mime', 'size', 'label', 'notes', 'uploaded_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function notes() {
        return $this->morphMany(Note::class, 'notable')->latest();
    }
}
