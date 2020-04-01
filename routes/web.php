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
//    Route::get('/user/dashboard',function(){
//        dd('ooo');
//    })->name('user.home');

    Route::get('/post/{post}-{slug}', 'PostController@show')->name('showing.post');
    Route::get('/category/{category}-{slug}/post', 'CategoryController@showCategoryPosts')->name('show.categories.posts');
    Route::get('tag/{tag}-{slug}/posts', 'TagController@showTagPosts')->name('show.tags.posts');
    Route::post('/post{post}/comment', 'CommentController@store')->name('store.comment');
    Route::post('/post/{post}/like', 'LikeController@like')->name('like.post');
    Route::post('/post/{post}/dislike', 'DisLikeController@dislike')->name('dislike.post');

    // Authentication Routes...
//    Route::group([
//        'prefix' => 'user',
//    ], function () {
        Route::get('user/login', 'Auth\LoginController@showLoginForm')->name('user.login');
        Route::post('user/login', 'Auth\LoginController@login')->name('user.login.send');
        Route::post('user/logout', 'Auth\LoginController@logout')->name('user.logout');

// Registration Routes...
        Route::get('user/register', 'Auth\RegisterController@showRegistrationForm')->name('user.register');
        Route::post('user/register', 'Auth\RegisterController@register')->name('user.send.register');


        // Password Reset Routes...
        Route::get('user/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
        Route::post('user/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
        Route::get('user/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('user.password.reset');
        Route::post('user/password/reset', 'Auth\ResetPasswordController@reset')->name('user.password.update');
//    });


//
//    $this->get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
//    $this->post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

});


//Route::get('/show-post',function(){
//    return view('user.posts.show');
//})->name('showing.post');


//Auth::routes();

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['web', 'auth:admin']
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

    Route::resource('user', 'UserController');

});
