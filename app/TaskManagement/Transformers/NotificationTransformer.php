<?php

namespace App\TaskManagement\Transformers;

class NotificationTransformer extends Transformer
{
    protected $resourceName = 'notification'; //override in parent Transformer

    public function transform($data)
    {
        return [
            'id'            => $data['id'], //will change this later...should use users email
            'email'         => $data['email'],
            'token'         => $data['token'],
            'name'			=> $data['name'],
            'avatar'        => $data['avatar'],
            'user_type'     => $data['user_type'],
            'department' => [
                'name'        => $data['department']['name'],
                'description' => $data['department']['description'],
                'id'          => $data['department']['id']
            ]
        ];
    }
}