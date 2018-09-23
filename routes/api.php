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
//login route
Route::post('/login', 'UserController@login');

Route::middleware(['auth:api'])->group(function () {
    //users routes
    Route::get('/user', 'UserController@user');

    //posts routes
    Route::get('/posts/filter/{categoryId}', 'PostController@list');
    Route::get('/posts', 'PostController@list');
    Route::delete('/posts/{postId}', 'PostController@destroy');
    Route::post('/posts', 'PostController@store');
    Route::put('/posts/{postId}', 'PostController@update');
    Route::get('/posts/{postId}', 'PostController@show');

    //categories routes
    Route::get('/categories', 'CategoryController@categories');

    //image routes
    Route::post('/images', 'ImageController@upload');
});


