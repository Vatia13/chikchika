<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function notifications()
    {
        $user = User::find(Auth::id());
        return $user->notifications;
    }


    public function unreadNotifications()
    {
        $user = User::find(Auth::id());
        return $user->unreadNotifications()->count();
    }


    public function read()
    {
        $user = User::find(Auth::id());
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    }
}
