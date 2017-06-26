<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\TaskManagement\Paginate\Paginate;
use App\User;
use Illuminate\Http\Request;

class FeedController extends ApiController
{
    /**
     * Get myTasks and 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // $user = auth()->user();

        $user = User::first();

        // error_log(print_r($user));

        // $tasks = new Paginate($user->feed());

        $tasks = $user->feed();

        dd($tasks);

        // return $this->respondWithPagination($tasks);
    }
}
