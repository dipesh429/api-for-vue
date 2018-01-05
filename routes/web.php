<?php

use App\Events\UserSigned;
use Illuminate\Support\Facades\Redis;



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
    // return view('welcome');


    // Redis::set('name','pyarii anjilaa');

	$data=[

		'name' => 'dipesh',
		'sex' => 'male'

	];

    Redis::publish('private',$data);


 	// event(new UserSigned("dkccc"));	

	return "hello";

});
