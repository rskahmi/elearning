<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Course;
use App\Models\Discussion;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('course.{courseId}', function ($user, $courseId) {
    return true; // sementara kita izinkan semua (nanti bisa dibuat validasi course)
});

Broadcast::channel('discussion.{discussionId}', function ($user, $discussionId) {
    return true;
});
