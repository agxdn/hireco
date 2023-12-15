<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarLocation>
 */
class CarLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'address' => $this->faker->word,
            'max_capacity' => $this->faker->randomNumber(),
            'latitude' => '40.7128',
            'longitude' => '74.0060',
        ];
    }
}
