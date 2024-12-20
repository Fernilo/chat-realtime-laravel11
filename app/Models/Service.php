<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'user_id'
    ];

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all of the comments for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chat(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * Get the service name.
     *
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }
}
