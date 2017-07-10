<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskSubscriptionController extends Controller
{
    /**
     * Store a new thread subscription.
     *
     * @param int    $channelId
     * @param Thread $thread
     */
    public function store(Thread $task)
    {
        $task->subscribe();
    }

    /**
     * Delete an existing task subscription.
     *
     * @param int    $channelId
     * @param task $task
     */
    public function destroy(Task $task)
    {
        $task->unsubscribe();
    }
}