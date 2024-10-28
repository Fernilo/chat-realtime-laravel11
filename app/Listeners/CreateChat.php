<?php

namespace App\Listeners;

use App\Events\CommentCreated;
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
    public function handle(CommentCreated $event): void
    {
        $chat = Chat::firstOrCreate([
            'created_by_id' => $event->comment->user_id,
            'service_id' => $event->comment->service_id
        ]);

        $event->comment->update([
            'chat_id' => $chat->id
        ]);
  
    }
}
