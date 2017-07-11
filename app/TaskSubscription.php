<?php

namespace App;

use App\Notifications\TaskProgressWasUpdated;
use App\Notifications\TaskWasCreated;
use App\Task;
use App\User;
use Illuminate\Database\Eloquent\Model;

class TaskSubscription extends Model
{
    protected $guarded = [];

     /**
     * Get the user associated with the subscription.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the thread associated with the subscription.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

     /**
     * Notify the related user that the task was created
     *
     * @param \App\Reply $reply
     */
    public function notify($type_of_notification, $object=null, $progress=null) {
    	if($type_of_notification == 'create') {
    		$this->user->notify(new TaskWasCreated($object) );	
    	}

        if($type_of_notification == 'update_progress_status') {
            $this->user->notify(new TaskProgressWasUpdated($object, $progress) );  
        }
    	
    }
}
