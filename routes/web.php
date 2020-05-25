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
//User Routes
//Route::redirect('/', '/'.locale()->current(), 301);
//Route::redirect('/'.app()->getLocale().'/admin/login/','/admin/login',301);
Route::redirect('/admin/login', '/' . app()->getLocale() . '/admin/login/', 301);
Route::redirect('/user/login', '/' . app()->getLocale() . '/user/login/', 301);
Route::redirect('/admin/home', '/' . app()->getLocale() . '/admin/login/', 301);


Route::get('/', 'User\WelcomeController@index')->middleware(['web', 'locale'])->prefix('{locale?}')->name('welcome');
Route::get('/set-locale', 'ChangeLocaleController@setLocale')->middleware(['web', 'locale'])->prefix('{user?}/{locale}')->name('setLocale');
//Route::get('/admin/login','Admin\Auth\LoginController@showLoginForm')->middleware(['web','locale'])->prefix('{locale}')->name('admin.login');
//Route::get('/set-locale','ChangeLocaleController@setLocale')->middleware(['web','locale'])->prefix(\App\Locale::getUrlSegment((string)Request::segment(1)))->name('setLocale');


Route::group([
//    'prefix'=> \App\Locale::getUrlSegment((string)Request::segment(1)),
    'prefix' => '{locale}',
    'middleware' => ['locale']
], function () {

    Route::group([
        'namespace' => 'User',
    ], function () {

//Route::get('set-locale','HomeController@setLocale')->middleware(['web'])->name('setLocale');

        Route::get('/post/{post}-{slug}', 'PostController@show')->name('showing.post');
        Route::get('/category/{category}-{slug}/post', 'CategoryController@showCategoryPosts')->name('show.categories.posts');
        Route::get('tag/{tag}-{slug}/posts', 'TagController@showTagPosts')->name('show.tags.posts');
        Route::group(['middleware' => ['web', 'auth']], function () {
//
            Route::post('/post{post}/comment', 'CommentController@store')->name('store.comment');
            Route::post('/post/{post}/like/{comment?}', 'LikeController@like')->name('like.post');
            Route::post('/post/{post}/dislike/{comment?}', 'DisLikeController@dislike')->name('dislike.post');
        });


        // Authentication Routes...
//    Route::get('user/home', function(){
//        return view('user.home');
//    })->middleware('web','auth')->name('user.home');

        Route::get('user/home', 'HomeController@index')->middleware('web', 'auth')->name('user.home');

//
//    $this->get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
//    $this->post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    });
    //User Routes

    Route::group([
        'namespace' => 'User',
        'middleware' => ['web', 'locale']
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

    //Admin Routes
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
    //Admin Routes

    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['web', 'auth:admin'],
    ], function () {
        Route::get('/home', 'HomeController@index')->name('admin.home');

        //Post
        Route::resource('post', 'PostController');
//Route::get('postss/{post}-{slug}','Admin\PostController@test')->name('test');

        // Category
        Route::resource('category', 'CategoryController');

        //Tag
        Route::resource('tag', 'TagController')->except('show');

        //Users

        Route::resource('user', 'UserController')->except('show');

        // Admins
        Route::resource('admin', 'AdminController')->except('show');

        // Roles
        Route::resource('role', 'RoleController')->except('show');

        //BLocked Users

        Route::get('blocked-users','BlockedUsersController@index')->name('blocked.users');

        Route::post('block-users/{user}/block','BlockedUsersController@block')->name('blockUser');

        Route::post('blocked-users/{user}/unblock','BlockedUsersController@unblock')->name('unblockUser');

        //Permission

        Route::resource('permission','PermissionController')->except('show');;

    });

});
