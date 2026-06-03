<?php

namespace Database\Factories;

use App\Models\Sport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sport>
 */
class SportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sports_name' => fake()->words(2, true),
            'category'=> fake()->randomElement([
                'Indoor',
                'Outdoor'
            ]),
            'no_of_players'=> fake()->numberBetween(1,15),
            'is_olympic'=> fake()->boolean(),
        ];
    }
}
