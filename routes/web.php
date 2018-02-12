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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/register', 'Auth\RegisterController@getRegister');

Route::get('/system_parameters', 'SystemParametersController@index');
Route::get('/system_parameters/edit', 'SystemParametersController@edit');
Route::post('/system_parameters', 'SystemParametersController@update');

Route::get('/positions', 'PositionController@index');
Route::get('/positions/create', 'PositionController@create');
Route::post('/positions', 'PositionController@add');
Route::post('/positions/delete', 'PositionController@delete');
