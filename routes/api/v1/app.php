<?php

use App\Http\Controllers\Api\v1\BookingController;
use App\Http\Controllers\Api\v1\CarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| App Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/cars', [CarController::class, 'all'])->name('cars.all');

    Route::post('/booking', [BookingController::class, 'createBooking'])->name('booking.create');
    Route::put('/booking/{booking}/update/pickup', [BookingController::class, 'updateBookingPickupLocation'])->name('booking.update.pickup-location');
    Route::delete('/booking/{booking}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
});

