<?php

namespace App\Models;

use App\Events\ChatCreating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'service_id',
        'chat_id',
        'message'
    ];
    protected $appends = ['time'];


    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service() :BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the chat that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }


    protected function time() :Attribute
    {
        return Attribute::make(
            get: fn () => date(
                "d-m-Y, H:i:s",
                strtotime($this->attributes['created_at'])
            )
        );
    }

}
