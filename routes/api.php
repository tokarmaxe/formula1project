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

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', 'UserController@user');
    Route::get('/posts/filter/{categoryId}', 'PostController@list');
    Route::get('/posts', 'PostController@list');
    Route::delete('/posts/{postId}', 'PostController@destroy');
    Route::post('/posts', 'PostController@store');
    Route::put('/posts/{postId}', 'PostController@update');
    Route::get('/posts/{postId}', 'PostController@show');
    Route::get('/categories', 'CategoryController@categories');
});

Route::post('/upload','ImageController@upload');


