<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateUser;
use App\TaskManagement\Transformers\UserTransformer;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    /**
     * UserController constructor.
     *
     * @param UserTransformer $transformer
     */
    public function __construct(UserTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api');
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithTransformer(auth()->user());
    }

    /**
     * Update the authenticated user and return the user if successful.
     *
     * @param UpdateUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUser $request)
    {
        $user = auth()->user();

        if ($request->has('user')) {
            $user->update($request->get('user'));
        }

        return $this->respondWithTransformer($user);
    }

    public function getAllUsers()
    {
        if(auth()->user()->user_type == 'department_head' ) {
            //get all users including Department heads
            $users = User::where('id','!=' , Auth::id())->get();
        }else {
            //get only normal users
            $users = User::where([
                ['user_type', 'normal'],
                ['id','!=' , Auth::id()],
                ])->get();    
        }
        

        return $this->respondWithTransformer($users);
    }

}
