<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api'], function() {
	
    
    // Route::get('profiles/me/tasks', 'ProfileController@authenticatedUserTasks');    
    // Route::get('profiles/me/categories', 'CategoryController@getTaskCategoriesForLoggedInUser');
    // Route::get('profiles/{user}/tasks', 'ProfileController@otherUsersTasks');

    // Task Progress
    Route::post('tasks/{task}/progress', 'TaskController@addProgressStatus');
    //Task subscriptions
    // Route::post('tasks/{task}/subscriptions', 'TaskSubscriptionController@store');
    // Route::delete('tasks/{task}/subscriptions', 'TaskSubscriptionController@destroy');
    //Get 'me' object
    Route::get('users/me', 'UserController@index');
    //Current logged in user tasks
    Route::get('users/me/tasks', 'TaskController@authenticatedUserTasks');
    //Get notifications
    Route::get('users/me/notifications', 'UserNotificationsController@index');
    //Delete notifications
    Route::delete('users/me/notifications/{notification}', 'UserNotificationsController@destroy');
    //Current logged in user categories
    Route::get('users/me/categories', 'CategoryController@getTaskCategoriesForLoggedInUser');
    //Other user's tasks
    Route::get('users/{user}/tasks', 'TaskController@otherUsersTasks');
    //View, Update, Delete, Edit a single task
	Route::resource('tasks', 'TaskController');
    //Get all users that can be assigned a task
    Route::get('users/all', 'UserController@getAllUsers');
    //Auth stuff
	Route::post('users/login', 'AuthController@login');
	Route::post('users', 'AuthController@register');

    //Get a departments tasks
    Route::get('departments/{department}/tasks', 'DepartmentController@getAllUsers');    
    //View, Update, Delete, Edit a single department
    Route::resource('departments', 'DepartmentController');
    // Route::get('/test', function () {
    // 	return JWTAuth::parseToken('token')->authenticate();
    // });


});