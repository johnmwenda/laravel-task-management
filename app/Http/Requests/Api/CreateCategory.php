<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\ApiRequest;



class CreateCategory extends ApiRequest
{
    
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->get('category') ?: [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|string|max:255',
            // 'progress_status_percent' => 'required',
            // 'progress_status' => 'required|integer',
            // 'due_date' => 'required|date',
            // 'assigned_user' => 'required',
        ];
    }
}

// task_id [url]
// user_id [auth]
// overall_status
// message
// progress_status
// 
// $this->validate($request, [
            // 'name'=>'required|max:100',
            // 'description' =>'required|max:100',
            // 'department_id' =>'required'
            // ]);