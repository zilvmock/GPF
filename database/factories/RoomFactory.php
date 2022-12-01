<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Room;
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
        $userIds = User::select('id')->pluck('id')->toArray();
        $gameIds = Game::select('id')->pluck('id')->toArray();

        return [
            'owner_id' => $userIds[rand(1, count($userIds) - 1)],
            'game_id' => $gameIds[rand(1, count($gameIds) - 1)],
//            'title' => $title,
            'title' => "[Kambarys] ".$title,
            'slug' => Str::Slug($title),
            'size' => rand(2, 4),
        ];
    }
}
