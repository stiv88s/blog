<?php

Route::group([  'prefix' => '{locale}',
    'middleware' => ['locale']],function(){
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


});

