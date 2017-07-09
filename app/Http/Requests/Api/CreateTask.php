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
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'summary' => 'required',
            'access_level' => 'required|string',
            'priority' => 'required|integer',
            // 'progress_status' => 'required|integer',
            'due_date' => 'required|date',
            'assignee_id' => 'required|exists:users,id',
            'notify' => 'sometimes'
        ];
    }
}

// {
//   "access_level": "public",
//   "priority": "Normal",
//   "category": {
//     "name": "EMPLOYEE ONBOARDING",
//     "description": "All tasks related to onboarding a new employee come here",
//     "department_id": 1,
//     "id": 1
//   },
//   "name": "asd",
//   "summary": "asd",
//   "due_date": "asd",
//   "assigned_user": "brenda@gmail.com",
//   "notify": {
//     "departments": [
//       1
//     ],
//     "members": []
//   }
// }


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