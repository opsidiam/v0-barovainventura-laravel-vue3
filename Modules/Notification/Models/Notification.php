<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    protected $fillable = [
        'type', 'scope', 'message', 'user_id', 'bar_id', 'url'
    ];

    protected $appends = ['is_read'];

    const UPDATED_AT = null;

    public function reads()
    {
        return $this->hasMany(NotificationRead::class);
    }

    public function scopeUnreadForUser($query, $userId)
    {
        return $query->whereDoesntHave('reads', function($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    public function scopeForUserContext($query, $userId, $barId = null)
    {
        return $query->where(function($q) use ($userId, $barId) {
            // Global notifications (no user_id or bar_id)
            $q->where('scope', 'global')
                ->whereNull('user_id')
                ->whereNull('bar_id');

            // User-specific notifications
            if ($userId) {
                $q->orWhere(function ($q2) use ($userId) {
                    $q2->where('scope', 'user')
                        ->where('user_id', $userId);
                });
            }

            // Bar-specific notifications (only if bar_id is set)
            if ($barId) {
                $q->orWhere(function($q3) use ($barId) {
                    $q3->where('scope', 'bar')
                        ->where('bar_id', $barId);
                });
            }
        })
            ->orderBy('created_at', 'desc');
    }

    public function markAsReadForUser($userId)
    {
        return NotificationRead::firstOrCreate([
            'notification_id' => $this->id,
            'user_id' => $userId
        ]);
    }

    /**
     * Get the read status for the current user
     */
    public function getIsReadAttribute()
    {
        if (!Auth::check()) {
            return true;
        }

        if (!array_key_exists('reads_count', $this->attributes)) {
            $this->load(['reads' => function($query) {
                $query->where('user_id', Auth::id());
            }]);
        }

        return $this->reads->isNotEmpty();
    }

    /**
     * Eager load read status for current user
     */
    public function scopeWithReadStatus($query, $userId)
    {
        return $query->withCount(['reads as is_read' => function($query) use ($userId) {
            $query->where('user_id', $userId);
        }]);
    }
}

class NotificationRead extends Model
{
    protected $table = 'notification_reads';
    public $timestamps = false;
    protected $fillable = ['notification_id', 'user_id'];
}
