<?php

namespace App\TaskManagement\Filters;

use App\TaskManagement\Filters\Filter;
use App\User;

class TaskFilter extends Filter
{
    
    /**
     * Filter by reportedByMe.
     * Get all the articles by the user with given username.
     *
     * @param $boolean... should be true
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function reportedByMe($param)
    {
        if($param === true || $param == 'true') {
            $user = auth()->user() ?: null;

            // dd($user->id); 

            $userId = $user ? $user->id : null;

            return $this->builder->whereUserId($userId);
        }   
    }

    /**
     * Filter by assignedToMe.
     * Get all the articles by the user with given username.
     *
     * @param $boolean... should be true
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function assignedToMe($param)
    {
        if($param === true || $param == 'true') {
            $user = auth()->user() ?: null;

            // dd($user->id); 

            $userId = $user ? $user->id : null;

            return $this->builder->whereAssigneeId($userId);
        }   
    }

    /**
     * Filter by private.
     * Get all the articles by the user with given username.
     *
     * @param $boolean... should be true
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function private_task($param)
    {
        if($param === true || $param == 'true') {
            $user = auth()->user() ?: null;

            // dd($user->id); 

            $userId = $user ? $user->id : null;

            return $this->builder->whereUserId($userId)->orWhere('assignee_id', $userId)->where('access_level', 'private' );
        }   
    }


    /**
     * Filter by private.
     * Get all the articles by the user with given username.
     *
     * @param $boolean... should be true
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function public_task($param)
    {
        if($param === true || $param == 'true') {
            $user = auth()->user() ?: null;

            // dd($user->id); 

            $userId = $user ? $user->id : null;

            return $this->builder->whereUserId($userId)->orWhere('assignee_id', $userId)->where('access_level', 'public' );
        }   
    }


    // EXAMPLE
    // protected function author($username)
    // {
    //     $user = User::whereUsername($username)->first();

    //     $userId = $user ? $user->id : null;

    //     return $this->builder->whereUserId($userId);
    // }

}