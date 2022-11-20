<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
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
            'owner_id' => User::select('id')->inRandomOrder()->first(),
            'game_id' => Game::select('id')->inRandomOrder()->first(),
            'title' => $title,
            'slug' => Str::Slug($title),
            'size' => rand(2, 4),
        ];
    }
}
