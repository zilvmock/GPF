<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'genres', 'summary', 'cover'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function scopeFilter($query, $input)
    {
        return $query->where('name', 'like', "%$input%")
            ->orWhere('genres', 'like', "%$input%");
    }
}
