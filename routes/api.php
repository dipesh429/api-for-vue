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

Route::get('users/check/{email}', 'UserController@check');
Route::get('users/verify/{code}', 'UserController@verify')->name('verify');
Route::apiResource('users', 'UserController');



Route::post('users/{user}/products', 'UserProductController@store');
Route::get('users/{user}/seller', 'UserProductController@seller');
Route::get('users/{user}/buyer', 'UserProductController@buyer');

Route::get('products/except/{id}', 'ProductController@products');
Route::apiResource('products', 'ProductController');

Route::post('products/{product}/categories', 'Product\ProductCategoryController@store');

Route::get('categories/find/{category}', 'Category\CategoryController@find');
Route::get('categories/{category}/products', 'Category\CategoryProductController@index');
Route::get('categories/{category}/products/except/{id}', 'Category\CategoryProductController@exceptproducts');
Route::apiResource('categories', 'Category\CategoryController');

Route::post('buyers/{buyer}/products/{product}/transactions', 'Transaction\TransactionController@store');

Route::apiResource('transactions','Transaction\TransactionController');



