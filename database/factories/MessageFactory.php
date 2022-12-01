<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = User::select('id')->pluck('id')->toArray();
        $roomIds = Room::select('id')->pluck('id')->toArray();

        return [
            'room_id' => $roomIds[rand(1, count($roomIds) - 1)],
            'user_id' => $userIds[rand(1, count($userIds) - 1)],
            'message' => fake()->sentence(rand(1, 10)),
        ];
    }
}
