<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', 'HomeController@index')->name('home');

Route::get('/', 'AngularController@serveApp');
Route::get('/unsupported-browser', 'AngularController@unsupported');
// Route::get('user/verify/{verificationCode}', ['uses' => 'Auth\AuthController@verifyUserEmail']);
// Route::get('auth/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider']);
// Route::get('auth/{provider}/callback', ['uses' => 'Auth\AuthController@handleProviderCallback']);
// Route::get('/api/authenticate/user', 'Auth\AuthController@getAuthenticatedUser');

// Auth::routes();


