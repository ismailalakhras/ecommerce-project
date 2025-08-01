<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

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
// Broadcast::routes(['middleware' => ['auth:admin']]); 


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('presence-chat-channel.{id}', function ($user ,$id) {
    return $user;
},['guards' => ['admin']]);

Broadcast::channel('presence-global-chat', function ($user) {
    return $user;
}, ['guards' => ['admin']]);


Broadcast::channel('presence-group-chat.{id}', function ($user) {
    return $user;
}, ['guards' => ['admin']]);
