<?php

namespace Database\Factories;

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
        return [
            'room_id' => rand(1, config('dbSeed.rooms')),
            'user_id' => rand(1, config('dbSeed.users')),
            'message' => fake()->sentence(rand(1, 10)),
        ];
    }
}
