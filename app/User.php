<?php

namespace App;

use App\Task;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JWTAuth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Generate a JWT token for the user.
     * important for our transformer which will try to get the token, so wrap in JWTAuth to get the token
     *
     * @return string
     */
    public function getTokenAttribute()
    {
        return JWTAuth::fromUser($this);
    }

    /**
     * tasks that this user has created, which can be many
     * @return [type] [description]
     */
    public function mytasks(){
       return $this->hasMany(Task::class);
    }

    /**
     * tasks that this user has been assigned to
     * @return [type] [description]
     */
    public function assigned_tasks(){
        return $this->belongsToMany(Task::class)->withTimeStamps();
    }

    /**
     * Get all the [reporter tasks] and [assigned tasks] of this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feed()
    {
        $assignedTasksIds = $this->assigned_tasks()->pluck('id')->toArray();

        error_log(print_r($assignedTasksIds, 1));

        // dd('hello');

        return Task::loadRelations()->whereIn('id', $assignedTasksIds)->orWhere('user_id', $this->id);
    }
}
 