<?php

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//Broadcast::channel('App.User.{id}', function ($user, $id) {
//    return (int)$user->id === (int)$id;
//});

Broadcast::channel('weeklyposts', function ($admin) {

//    return (int)true;
    return (int)$admin->isAdmin();
});

Broadcast::channel('post_updated.{id}', function ($admin,$id) {

//    return ['user' =>$admin,'id'=>$id];

    if(!$admin->isAdmin()){
        return false;
    }

    return (int)$admin->id == $id;
});
