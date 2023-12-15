<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_location_id' => \App\Models\CarLocation::factory(),
            'model' => $this->faker->word,
            'year' => $this->faker->year,
            'color' => $this->faker->colorName,
            'registration_number' => $this->faker->word,
            'description' => $this->faker->word,
            'daily_rate' => $this->faker->numberBetween(100, 300),
        ];
    }
}
