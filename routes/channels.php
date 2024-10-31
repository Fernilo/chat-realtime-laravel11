<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat_{chatId}', function () {
    return true;
});
