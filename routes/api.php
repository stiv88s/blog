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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/posts', 'PostController@index');
    Route::get('/posts/{post}', 'PostController@show');
    Route::post('/like/{model_id}', 'LikeController@like');
    Route::post('/dislike/{model_id}', 'DislikeController@dislike');

});

Route::post('/register', 'AuthController@register')->middleware('guest');



