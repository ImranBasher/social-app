<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch all notifications
        $notifications = $user->notifications;

        // Fetch only unread notifications
        $unreadNotifications = $user->unreadNotifications;

        // Return the notifications to a view
        return view('notifications.index', compact('notifications', 'unreadNotifications'));
    }

    public function markAsRead($id)
    {
        $user = Auth::user();

        // Find the specific notification
        $notification = $user->notifications()->find($id);

        if ($notification) {
            // Mark the notification as read
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    public function markAllAsRead()
    {
        $user = Auth::user();

        // Mark all unread notifications as read
        $user->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
