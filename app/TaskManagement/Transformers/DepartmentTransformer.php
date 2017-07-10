<?php

namespace App\TaskManagement\Transformers;

use App\TaskManagement\Transformers\Transformer;

class DepartmentTransformer extends Transformer
{
    protected $resourceName = 'department'; //override in parent Transformer

    public function transform($data)
    {
        return [
            'dep_id'            => $data['id'],
            'name'              => $data['name'],
            'description'       => $data['description'],
            'members'           => $data['members']
        ];
    }


    // $table->unsignedInteger('department_id');
    // $table->string('name');
    // $table->text('description');
}