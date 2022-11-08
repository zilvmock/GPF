<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
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
            'title' => $title,
            'slug' => Str::Slug($title),
            'genre' => fake()->word(),
            'description' => fake()->sentence(rand(2, 10)),
        ];
    }
}
