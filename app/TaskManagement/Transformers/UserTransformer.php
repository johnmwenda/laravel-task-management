<?php

namespace App\TaskManagement\Transformers;

class UserTransformer extends Transformer
{
    protected $resourceName = 'user'; //override in parent Transformer

    public function transform($data)
    {
        return [
            'email'         => $data['email'],
            'token'         => $data['token'],
            'name'			=>$data['name'],
            'avatar'        =>$data['avatar'],
            'user_type'     =>$data['user_type'],
            'department' => [
                'name'        => $data['department']['name'],
                'description' => $data['department']['description'],
                'id'          => $data['department']['id']
            ]
        ];
    }
}