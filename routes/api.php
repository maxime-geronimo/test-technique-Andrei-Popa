<?php

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

Route::get('image/all', [
    'as' => 'all', 'uses' => 'Api\ImageController@all'
]);


Route::get('image/{id}', [
    'as' => 'image', 'uses' => 'Api\ImageController@get'
]);
