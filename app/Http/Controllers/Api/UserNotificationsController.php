<?php

namespace App\Http\Controllers\Api;

use App\TaskManagement\Transformers\NotificationTransformer;

// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class UserNotificationsController extends ApiController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(NotificationTransformer $transformer)
    {
        $this->middleware('auth.api');

        $this->transformer = $transformer;
    }

    /**
     * Fetch all unread notifications for the user.
     *
     * @return mixed
     */
    public function index()
    {
        // dd('called');
        return $this->respondWithTransformer(auth()->user()->unreadNotifications); 
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
