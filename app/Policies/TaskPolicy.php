<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;


    //add before method to override if current user is department_head and this task belongs to your department
    public function before($user, Task $task)
    {
        if($user->user_type == 'department_head' && $user->department_id == $task->department_id)
        {
            return true
        }
    }
    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {   
        //private tasks should only be viewed by reporter,assigned user and department head
        if($task->access_level == 'private') {
            if($user->id == $task->user_id || $user->id == $task->assignee_id) {
                return true;
            }
        }

        if($task->access_level == 'public') { 
            return true;
        }

    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the task.
     *
     * Can update task if ur reporter/assignee
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        return $task->user_id == $user->id || $task->assignee_id == $user->id;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        //
    }
}
