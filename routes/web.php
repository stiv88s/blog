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




Route::group(['namespace' => 'User'], function () {
    Route::get('/', 'HomeController@index')->name('welcome');
    Route::get('/post/{post}-{slug}', 'PostController@show')->name('showing.post');
    Route::post('/post{post}/comment','CommentController@store')->name('store.comment');
    Route::post('/post/{post}/like','LikeController@like')->name('like.post');
    Route::post('/post/{post}/dislike','DisLikeController@dislike')->name('dislike.post');

});


//Route::get('/show-post',function(){
//    return view('user.posts.show');
//})->name('showing.post');



Auth::routes();
Route::group([
    'prefix' => 'admin',
    'namespace' =>'Admin',
    'middleware'=> ['web','auth']
], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //Post
    Route::resource('post', 'PostController');
//Route::get('postss/{post}-{slug}','Admin\PostController@test')->name('test');

    // Category
    Route::resource('category', 'CategoryController');

    //Tag
    Route::resource('tag', 'TagController');

    //Users

    Route::resource('user','UserController');

});
