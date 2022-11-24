<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'slug', 'genres', 'summary', 'cover'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
