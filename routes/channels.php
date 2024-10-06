<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;


Broadcast::channel('chat_{userId}', function () {
    return true;
});
