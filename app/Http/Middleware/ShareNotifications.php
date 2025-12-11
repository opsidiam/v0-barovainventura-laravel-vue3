<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Notification\Models\Notification;
use Symfony\Component\HttpFoundation\Response;

class ShareNotifications
{
    public function handle(Request $request, Closure $next): Response
    {
        $notificationData = [
            'count' => 0,
            'notifications' => []
        ];

        if (Auth::check()) {
            $notificationData = $this->getNotifications(Auth::id(), session('bar_id'));
        }

        view()->witch([
            'notification_count' => $notificationData['count'],
            'notifications' => $notificationData['notifications'],
        ]);

        return $next($request);
    }

    protected function getNotifications($userId, $barId = null)
    {
        $query = Notification::forUserContext($userId, $barId)
            ->unreadForUser($userId);

        return [
            'count' => $query->count(),
            'notifications' => $query->limit(5)->get()
        ];
    }
}
