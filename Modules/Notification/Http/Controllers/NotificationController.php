<?php

namespace Modules\Notification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Notification\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::forUser(auth()->user())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }


    public function markAllAsRead()
    {
        $userId = auth()->id();
        $barId = session('bar_id');

        $unreadNotifications = Notification::forUserContext($userId, $barId)
            ->unreadForUser($userId)
            ->get();

        // Mark them as read
        foreach ($unreadNotifications as $notification) {
            $notification->markAsReadForUser($userId);
        }

        cache()->forget('user_notifications_' . $userId . '_' . ($barId ?? 'null'));

        return response()->json([
            'success' => true,
            'count' => 0
        ]);
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:error,success,warning',
            'scope' => 'required|in:user,bar,global',
            'message' => 'required',
            'user_id' => 'required_if:scope,user|exists:users,id',
            'bar_id' => 'required_if:scope,bar|exists:bars,id',
            'url' => 'nullable|url'
        ]);

        Notification::create($data);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notification created successfully');
    }
}
