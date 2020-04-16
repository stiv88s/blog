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

Route::redirect('/', '/'.locale()->current(), 301);

Route::group([
    'prefix'=> \App\Locale::getUrlSegment((string)Request::segment(1)),
    'middleware'=> ['locale']
],function(){


Route::group([
    'namespace' => 'User',
//    'prefix'=> (string)Request::segment(1),
//    'prefix'=> \App\Locale::getUrlSegment((string)Request::segment(1)),
//    'middleware'=> ['locale']

], function () {
    Route::get('/', 'HomeController@index')->middleware(['web'])->name('welcome');
//    Route::get('/user/dashboard',function(){
//        dd('ooo');
//    })->name('user.home');
Route::get('set-locale','HomeController@setLocale')->middleware(['web'])->name('setLocale');

    Route::get('/post/{post}-{slug}', 'PostController@show')->name('showing.post');
    Route::get('/category/{category}-{slug}/post', 'CategoryController@showCategoryPosts')->name('show.categories.posts');
    Route::get('tag/{tag}-{slug}/posts', 'TagController@showTagPosts')->name('show.tags.posts');
    Route::group(['middleware'=>['web','auth']],function () {
        Route::post('/post{post}/comment', 'CommentController@store')->name('store.comment');
        Route::post('/post/{post}/like', 'LikeController@like')->name('like.post');
        Route::post('/post/{post}/dislike', 'DisLikeController@dislike')->name('dislike.post');
    });


    // Authentication Routes...
    Route::get('user/home', function(){
        return view('user.home');
    })->middleware('web','auth')->name('user.home');



//
//    $this->get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
//    $this->post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

});

Route::group([
    'namespace' => 'User'
], function () {
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
});


Route::group([
    'namespace' => 'Admin'
], function () {
    Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'Auth\LoginController@login')->name('admin.login.send');
    Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
// Registration Routes...
//    Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
//    Route::post('admin/register', 'Auth\RegisterController@register')->name('admin.send.register');


    // Password Reset Routes...
    Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
});

//Route::get('/show-post',function(){
//    return view('user.posts.show');
//})->name('showing.post');


//Auth::routes();

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['web','auth:admin'],
], function () {
    Route::get('/home', 'HomeController@index')->name('admin.home');

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

});
