<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;

// requests about validation ??
use App\Http\Requests\Api\LoginUser;
use App\Http\Requests\Api\RegisterUser;
use App\TaskManagement\Transformers\UserTransformer;


// use Illuminate\Http\Request;

class AuthController extends ApiController
{
    // this is the auth controller. it will handle API User Auth, that is Login/Register etc
    // 
    
     /**
     * AuthController constructor.
     *
     * @param UserTransformer $transformer
     */
    public function __construct(UserTransformer $transformer)
    {

        $this->transformer = $transformer; //set this on the parent ApiController

        

        // dd(print_r($this->transformer, true));

        // error_log(print_r($this->transformer, true));
    }

    /**
     * Login user and return the user if successful.
     *
     * @param LoginUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUser $request)
    {
        // throw new Exception('noma sana'); 

        $credentials = $request->only('user.email', 'user.password');
        $credentials = $credentials['user'];

        if (! Auth::once($credentials)) {
            return $this->respondFailedLogin();
        }   

        // error_log(print_r(auth()->user(), 1 ));
        return $this->respondWithTransformer(auth()->user());
    }

    /**
     * Register a new user and return the user if successful.
     *
     * @param RegisterUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUser $request)
    {
        $user = User::create([
            'username' => $request->input('user.username'),
            'email' => $request->input('user.email'),
            'password' => $request->input('user.password'),
        ]);

        return $this->respondWithTransformer($user);
    }

}




