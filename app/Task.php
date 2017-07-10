<?php

namespace App;

use App\Department;
use App\Progress;
use App\TaskManagement\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use Filterable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'summary', 'access_level', 'prority', 'due_date', 'progress_status'
    // ]; 
    // 
    protected $guarded = [];

    protected $with = [
        'department','assignee', 'reporter'
    ];

    // protected $appends = [
    //     'isSubscribedTo'
    // ];
    // $table->string('name');
    // $table->text('summary');
    // $table->string('access_level');
    // $table->smallInteger('prority');
    // $table->dateTime('due_date');
    // $table->smallInteger('progress_status'); //1%-100%
    
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    // protected $with = [
    //     'tags'
    // ];

    /**
     * a task must belong to reporter/creator []
     * @return [type] [description]
     */
    public function reporter(){
    	return $this->belongsTo(User::class);
    }

    /**
     * Get the assignees that have been assigned
     * @return [type] [description]
     */
    public function assignee() {
    	return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the task
     * @return [type] [description]
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the department of the task
     * @return [type] [description]
     */
    public function department() {
        return $this->belongsTo(Department::class);
    }

    /**
     * Load all required relationships with only necessary content.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function scopeLoadRelations($query) {
    //     return $query->with('category')
    //         ->with('assignee')
    //         ->with('reporter');
    // }

    // public function scopeLoadRelations($query)
    // {
    //     return $query->with(['user.followers' => function ($query) {
    //             $query->where('follower_id', auth()->id());
    //         }])
    //         ->with(['favorited' => function ($query) {
    //             $query->where('user_id', auth()->id());
    //         }])
    //         ->withCount('favorited');
    // }
    
    /**
     * add Progress status
     * @return [type] [description]
     */
    public function addProgressStatus($progress) {
        
        // return $this->belongsTo(Department::class);
        $this->progresses()->create($progress);
    }

    /**
     * a task may have many progress messages and statuses, 0%, 20%, 30%
     * @return [type] [description]
     */
    public function progresses() {
        
        return $this->hasMany(Progress::class);
    }


    /**
     * A task has one or many subscriptions
     * @return [type] [description]
     */
    public function subscriptions() {
        
        // return $this->hasMany(Progress::class);
        return $this->hasMany(TaskSubscription::class);
    }

    /**
     * users_array is a list of valid user_ids
     * @param  [type] $users_array [description]
     * @return [type]              [description]
     */
    public function users_subscribe($users_array) {
        $filtered = User::whereIn('id', $users_array )->get();

        foreach ($filtered as $value) {
            print_r($value->id);
        }
    }

    public function departments_subscribe($departments_array) {

        // dd(auth()->user()->email);
        $filtered_departments = Department::whereIn('id', $departments_array )->get();

        // dd($filtered_departments[0] -> members() -> get());
        foreach ($filtered_departments as $department) {
            foreach($department->members()->where('email','!=' , auth()->user()->email)->get() as $member) {
                $this->subscribe($member->id);
            }
        }
    }


    /**
     * A user may subscribe(follow) to a thread
     * @return [type] [description]
     */
    public function subscribe($userId = null) {
        $this->subscriptions()->create([
                'user_id' => $userId ?: auth()->id()
            ]);
        // return $this->hasMany(Progress::class);
        return $this;
    }


    /**
     * Unsubscribe a user from the current task.
     *
     * @param int|null $userId
     */
    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();

        return $this;
    }

    /**
     * check if auth user has subscribed to this task
     *
     * @param int|null $userId
     */
    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function notifyTaskCreatedToSubscribers() {
        $this->subscriptions
        ->where('user_id', '!=', $this->user_id)
        ->each
        ->notify('create', $this);
    }

    
}
