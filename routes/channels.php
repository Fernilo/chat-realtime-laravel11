<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;


Broadcast::channel('chat.{userId}', function ($user) {
    return true;
});
