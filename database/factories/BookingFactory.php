<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_id' => \App\Models\Car::factory(),
            'user_id' => \App\Models\User::factory(),
            'pickup_location_id' => \App\Models\CarLocation::factory(),
            'dropoff_location_id' => \App\Models\CarLocation::factory(),
            'booking_policy_id' => \App\Models\BookingPolicy::factory(),
            'booking_policy_cost' => $this->faker->numberBetween(0, 100),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'daily_rate' => $this->faker->numberBetween(50, 300),
        ];
    }
}
