<?php

namespace App\Listeners;

use App\Events\CommentCreating;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Chat;

class CreateChat
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentCreating $event): void
    {
        $chat = Chat::create(
            [
                'created_by_id' => $event->comment->user_id,
                'service_id' => $event->comment->service_id
            ]
        );
   
        $event->comment->chat_id = $chat->id;
    }
}
