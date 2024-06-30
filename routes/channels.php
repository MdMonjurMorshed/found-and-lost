<?php

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
// Broadcast::routes(['middleware' => ['auth.guard:web']]);
Broadcast::channel('chat.{message_id}', function ($user,$message_id) {
   
    return Auth::guard('web')->check() ;
});


