<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = str_replace('.', '', fake()->unique()->sentence(rand(1, 5)));
        return [
            'owner_id' => rand(1, config('dbSeed.users')),
            'game_id' => rand(1, config('dbSeed.games')),
            'title' => $title,
            'slug' => Str::Slug($title),
            'size' => rand(1, 4),
        ];
    }
}
