<?php

namespace Database\Seeders;

use App\Models\BookingPolicy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\CarLocation;
use App\Models\Booking;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add users
        User::factory()->count(10)->create();

        // add car locations
        $firstCarLocation = CarLocation::factory()->create([
            'name' => 'London',
            'address' => '3 Starting Lane, London, SW2 1KX',
        ]);

        CarLocation::factory()->create([
            'name' => 'Birmingham',
            'address' => '19 Hill Street, Birmingham, B5 4BE',
        ]);

        // add booking policies
        BookingPolicy::factory()->create([
            'name' => 'age_below_21',
            'description' => 'Standard booking policy',
            'key' => 'standard',
            'cost' => '150',
        ]);

        BookingPolicy::factory()->create([
            'name' => 'age_below_25',
            'description' => 'Standard booking policy',
            'key' => 'standard',
            'cost' => '50',
        ]);

        // add cars and bookings
        $cars = Car::factory()
                    ->count(10)
                    ->hasBookings(2, [
                        'pickup_location_id' => $firstCarLocation->id,
                        'dropoff_location_id' => $firstCarLocation->id,
                        'start_date' => '2023-01-01 07:00:00',
                        'end_date' => '2023-01-03 07:00:00',
                    ])
                    ->create([
                        'car_location_id' => $firstCarLocation->id,
                    ]);
    }
}
