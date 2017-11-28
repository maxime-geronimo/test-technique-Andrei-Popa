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
Route::get('/', [
    'as' => 'main', 'uses' => 'ImageController@index'
]);

Route::post('process', [
    'as' => 'uploadProcess', 'uses' => 'ImageController@uploadProcess'
]);

Route::any('setDefault/{id}', [
    'as' => 'setDefault', 'uses' => 'ImageController@setDefault'
]);

Route::get('edit/{id}', [
    'as' => 'edit', 'uses' => 'ImageController@edit'
]);

Route::post('edit/{id}', [
    'as' => 'editProcess', 'uses' => 'ImageController@editProcess'
]);

Route::any('delete/{id}', [
    'as' => 'delete', 'uses' => 'ImageController@delete'
]);