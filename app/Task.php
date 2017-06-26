<?php

namespace App;

use App\TaskManagement\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Filterable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'summary', 'access_level', 'prority', 'due_date', 'progress_status'
    ]; 

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
    public function assignees() {
    	return $this->belongsToMany(User::class);
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
    public function scopeLoadRelations($query) {
        return $query->with(['category'])
            ->with(['assignees']);
    }

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
}
