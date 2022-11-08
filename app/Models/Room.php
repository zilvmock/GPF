<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'size', 'locked'];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function game()
    {
        return $this->BelongsTo(Game::class, 'game_id');
    }

    public function message()
    {
        return $this->HasMany(Message::class);
    }
}
