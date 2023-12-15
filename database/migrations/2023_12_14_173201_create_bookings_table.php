<?php

use App\Models\BookingPolicy;
use App\Models\CarLocation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Car;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Car::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(CarLocation::class, 'pickup_location_id');
            $table->foreignIdFor(CarLocation::class, 'dropoff_location_id');
            $table->foreignIdFor(BookingPolicy::class)->nullable();
            $table->string('booking_policy_cost')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('daily_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
