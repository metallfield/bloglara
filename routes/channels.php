<?php

use App\Chat_message;
use App\User;
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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chatbox_{to_user_id}', function ($user, $to_user_id) {
    return  Chat_message::where([['from_user_id', $user->id], ['to_user_id', $to_user_id]])->orWhere([['from_user_id', $to_user_id],['to_user_id', $user->id]])->count() > 0;
});
