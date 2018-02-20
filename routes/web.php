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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'RequestController@personalRequests');

Route::get('/register', 'Auth\RegisterController@getRegister');

Route::group(['middleware' => 'leader'], function () {
    Route::get('/system_parameters', 'SystemParametersController@index');
    Route::get('/system_parameters/edit', 'SystemParametersController@edit');
    Route::post('/system_parameters', 'SystemParametersController@update');

    Route::get('/positions', 'PositionController@index');
    Route::get('/positions/create', 'PositionController@create');
    Route::post('/positions', 'PositionController@add');
    Route::post('/positions/delete', 'PositionController@delete');

    Route::post('/users/block', 'UserController@changeLock');
    Route::get('/users/block/{id}', 'UserController@block');

    Route::get('/requests', 'RequestController@index');
    Route::get('/requests/user/{id}', 'RequestController@allByUserId');
    Route::post('/requests/state', 'RequestController@changeState');
});

Route::group(['middleware' => 'employee'], function () {
    Route::get('/users', 'UserController@index');
    Route::get('/users/edit/{id}', 'UserController@edit');
    Route::post('/users', 'UserController@update');

    Route::get('/account', 'UserController@account');
    Route::get('/account/password', 'UserController@editPassword');
    Route::post('/account/password', 'UserController@changePassword');

    Route::get('/stats', 'StatisticsController@personalStats');

    Route::post('/requests', 'RequestController@add');
    Route::get('/requests/edit/{id}', 'RequestController@edit');
    Route::post('/requests/update', 'RequestController@update');
    Route::post('/requests/delete', 'RequestController@delete');
    Route::get('/requests/print/{id}', 'RequestController@printRequest');

    Route::get('/requests/history/{id}', 'RequestHistoryController@index');
});