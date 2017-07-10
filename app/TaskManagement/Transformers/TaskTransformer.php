<?php

namespace App\TaskManagement\Transformers;

use App\TaskManagement\Transformers\Transformer;
use Log;

class TaskTransformer extends Transformer {
	protected $resourceName = 'task';

    public function transform($data)
    {	

    	// return $data;

        return [
            'id'                 => $data['id'],
            'name'               => $data['name'],
            'summary'            => $data['summary'],
            'access_level'       => $data['access_level'],
            'priority'           => $data['priority'],
            'due_date'           => $data['due_date'],
            'progress'           => $data['progresses'],
            'isSubscribedTo'     =>$data['isSubscribedTo'], //get mutator
            'category' => [
                'name'      => $data['category']['name'],
                'id'        => $data['category']['id'],
            ],
            'reporter' => [
                'username'  => $data['reporter']['name'],
                'email'     => $data['reporter']['email'],
                'avatar'    => $data['reporter']['avatar'],
            ],
            'assignee' => [
                'name'      => $data['assignee']['name'],
                'email'     => $data['assignee']['email'],
                'avatar'    => $data['assignee']['avatar'],
            ]
        ];
    }
}

// $table->unsignedInteger('user_id');
// $table->unsignedInteger('department_id');
// $table->unsignedInteger('category_id');
// $table->unsignedInteger('assigned_user_id');
// $table->string('name');
// $table->text('summary');
// $table->string('access_level');
// $table->smallInteger('prority');
// $table->dateTime('due_date');