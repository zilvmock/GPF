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

    public function scopeFilter($query, $name, $genres)
    {
        if (empty($genres)) {
            return $query->where('name', 'like', '%' . $name . '%');
        } else {
            return $query->where('name', 'like', '%' . $name . '%')
                ->where(function ($query) use ($genres) {
                    foreach ($genres as $genre) {
                        $query->orWhere('genres', 'like', '%' . $genre . '%');
                    }
                });
        }
    }
}
