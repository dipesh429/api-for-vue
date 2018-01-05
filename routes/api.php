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

Route::get('users', 'UserController@index');
Route::post('users', 'UserController@store');
Route::post('cars/{user}', 'CarController@store');

Route::post('wastes/{user}', 'WasteController@store');
Route::get('wastes', 'WasteController@index');
Route::post('wastes/order/{waste}/{user}', 'WasteController@order');

Route::get('cars/average/{user}/{week}', 'CarController@weekaverage');
Route::get('cars/{user}/{week}/{day}', 'CarController@daywise');
Route::get('cars/{user}/{week}', 'CarController@weekwise');
// Route::get('cars/average/{user}/{week}', 'CarController@weekaverage');

// Route::post('cars/{user}/{week}/{day}', 'CarController@store');
Route::post('users/login', 'UserController@login');


Route::get('users/put/{user}', 'UserController@put');

//reward

Route::get('reward/{user}', 'RewardController@index');



