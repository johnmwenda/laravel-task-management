<?php

namespace App\TaskManagement\Transformers;

class CategoryTransformer extends Transformer
{
    protected $resourceName = 'category'; //override in parent Transformer

    public function transform($data)
    {
        return [
            'name'              => $data['name'],
            'description'       => $data['description'],
            'department_id'	    => $data['department_id'],
            
        ];
    }


    // $table->unsignedInteger('department_id');
    // $table->string('name');
    // $table->text('description');
}