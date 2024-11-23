<?php

namespace App\Listeners;

use App\Events\ChatCreating;
use App\Events\GotComment;
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
    public function handle(ChatCreating $event): void
    {
        $chat = Chat::create(
            [
                'created_by_id' => $event->idUser,
                'service_id' => $event->idService
            ]
        );

        GotComment::dispatch($chat->toArray());
   
        // $event->comment->chat_id = $chat->id;
    }
}
