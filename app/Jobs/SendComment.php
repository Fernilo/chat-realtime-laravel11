<?php

namespace App\Jobs;

use App\Events\GotComment;
use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendComment implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Comment $comment)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        GotComment::dispatch([
            'id' => $this->comment->chat_id
        ]);
    }
}
