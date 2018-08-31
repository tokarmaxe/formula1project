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

Route::post('/login', 'UserController@login');

Route::middleware(['auth.api'])->group(function () {
    Route::get('/user', 'UserController@user');
    Route::get('/posts', 'PostController@list');
    Route::post('/posts', 'PostController@create');



});

