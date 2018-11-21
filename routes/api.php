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
    Route::get('/user/{userId}', 'UserController@getUser');
    Route::put('/user/{userId}', 'UserController@update');
    Route::get('/posts/filter/{categoryId}', 'PostController@list');
    Route::get('/posts/filter/user/{userId}', 'PostController@usersAds');
    Route::get('/posts', 'PostController@list');
    Route::delete('/posts/{postId}', 'PostController@destroy');
    Route::post('/posts', 'PostController@store');
    Route::put('/posts/{postId}', 'PostController@update');
    Route::get('/posts/{postId}', 'PostController@show');
    Route::get('/categories', 'CategoryController@categories');
    Route::post('/comments', 'CommentController@store');
    Route::get('/comments/{commentId}', 'CommentController@show');
    Route::put('/comments/{commentId}', 'CommentController@update');
    Route::delete('/comments/{comentId}', 'CommentController@destroy');
    Route::get('/comments/filter/{postId}', 'CommentController@list');

    Route::post('/images', 'ImageController@upload');
    Route::get('/images/{imageId}', 'ImageController@show');
    Route::get('/images/filter/{postId}', 'ImageController@imagesByPostId');
    Route::delete('/images/{imageId}', 'ImageController@destroy');

    Route::post('/image_thumb', 'ImageController@uploadToTempFolder');
    Route::delete('/image_thumb/{tempId}', 'ImageController@deleteFromUserFolder');

    Route::post('/search', 'PostController@search');
});


