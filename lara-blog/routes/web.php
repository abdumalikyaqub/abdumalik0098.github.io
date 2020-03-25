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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
        Route::group(['middleware' => ['auth']], function () {
                //----User profile----
        Route::get('/profile', ['uses'=>'UserController@profile', 'as'=>'users.profile']);
        Route::get('/profile/edit', ['uses'=>'UserController@edit', 'as'=>'users.edit']);
        Route::post('/profile/edit', ['uses'=>'UserController@update', 'as'=>'users.update']);
        Route::get('/profile/password', ['uses'=>'UserController@editPassword', 'as'=>'users.edit_password']);
        Route::post('/profile/password', ['uses'=>'UserController@updatePassword', 'as'=>'users.update_password']);
        Route::post('/get_experience','UserController@getExperience');
        Route::post('/set_experience','UserController@setExperience');
        //--------------------
    });
});