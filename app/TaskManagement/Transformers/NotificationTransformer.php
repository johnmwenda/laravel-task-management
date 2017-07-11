<?php

namespace App\TaskManagement\Transformers;

class NotificationTransformer extends Transformer
{
    protected $resourceName = 'notification'; //override in parent Transformer

    public function transform($data)
    {
        return [
            'id'                => $data['id'], //will change this later...should use users email
            'data'              => $data['data'],
            'notifiable_type'   => $data['notifiable_type'],
            'read_at'			=> $data['read_at'],
            'task_id'           => $data['task_id'],
            'owner'             => $data['owner'],
        ];
    }
}