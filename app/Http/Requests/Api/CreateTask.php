<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\ApiRequest;



class CreateTask extends ApiRequest
{
    
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->get('task') ?: [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'summary' => 'required',
            'access_level' => 'required|string',
            'priority' => 'required|integer',
            'progress_status' => 'required|integer',
            'due_date' => 'required|date'
        ];
    }
}


 // $table->increments('id');
 //            $table->unsignedInteger('user_id');
 //            $table->unsignedInteger('department_id');
 //            $table->unsignedInteger('category_id');

 //            $table->string('name');
 //            $table->text('summary');
 //            $table->string('access_level');
 //            $table->smallInteger('prority');
 //            $table->dateTime('due_date');
 //            $table->smallInteger('progress_status'); //1%-100%