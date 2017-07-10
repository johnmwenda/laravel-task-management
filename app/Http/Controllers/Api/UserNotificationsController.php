<?php

namespace App\Http\Controllers\Api;

// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class UserNotificationsController extends ApiController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth.api');
    }

    /**
     * Fetch all unread notifications for the user.
     *
     * @return mixed
     */
    public function index()
    {
        // dd('called');
        return auth()->user()->unreadNotifications; 
    }

    /**
     * Mark a specific notification as read.
     *
     * @param \App\User $user
     * @param int       $notificationId
     */
    public function destroy($notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
