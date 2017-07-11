<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $guarded = [];

    protected $with = ['owner'];

    /**
     * a progress must belong to creator
     * @return [type] [description]
     */
    public function owner(){
    	return $this->belongsTo(User::class, 'user_id');
    }
}
