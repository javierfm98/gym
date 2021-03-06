<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login' , 'AuthController@login');
Route::get('/trainings' , 'TrainingController@index');

Route::middleware('auth:api')->group(function () {

    Route::get('/user', 'UserController@show');
    Route::post('/logout' , 'AuthController@logout');
    Route::post('/trainings' , 'TrainingController@store');
    Route::get('trainings/reserves' , 'UserController@reservation');
    Route::get('trainings/check' , 'UserController@check');
    Route::post('trainings/{training}' , 'TrainingController@destroy');
    Route::get('trainings/{training}' , 'TrainingController@show');
    Route::post('users/update' , 'UserController@update');
    Route::get('users/subscription' , 'UserController@subs');
    Route::get('chart' , 'ChartController@getDataChart');
    Route::get('chart/store' , 'ChartController@store');
    Route::get('chart/goal/store' , 'ChartController@storeGoal');
    Route::get('chart/list' , 'ChartController@list');
    Route::post('chart/destroy/{body}' , 'ChartController@destroy');
    Route::get('chart/goal/show' , 'ChartController@getGoal');
    Route::post('image' , 'UserController@uploadImage');
    Route::post('users/password' , 'UserController@password');

});

