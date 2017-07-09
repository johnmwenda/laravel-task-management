<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Department extends Model
{
    /**
     * Load all required relationships with only necessary content.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoadUserRelations($query)
    {
        // dd("called");
        return $query->with(['users' => function ($query) {
            $query->where('id','!=' , Auth::id());
        }]);
    }

    public function members()
    {
    	return $this->hasMany(User::class);
    }
}
