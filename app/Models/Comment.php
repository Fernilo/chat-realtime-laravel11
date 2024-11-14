<?php

namespace App\Models;

use App\Events\CommentCreating;
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

    // ver en detalle esto
    protected static function boot()
    {
        parent::boot();

        // El $comment es un parámetro que Laravel pasa automáticamente al closure cuando se está creando un nuevo 
        // comentario. Este parámetro solo existe dentro del ámbito del closure (entre las llaves { }).
        static::creating(function ($comment) {
            if($comment->chat_id == null){
            event(new CommentCreating($comment));
            }
        });
    }
}
