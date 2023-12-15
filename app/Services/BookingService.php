<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Carbon\Carbon;
use Exception;
use Log;

/**
 * Class BookingService
 *
 * @property BookingRepository $bookingRepository
 *
 * @package App\Services
 */
class BookingService
{

    /**
     * BookingService constructor
     *
     * @return void
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Book a car
     */
    public function bookCar($car, $userId, $startDate, $endDate, $pickupLocationId, $dropoffLocationId, $policy = null)
    {
        try {
            return $this->bookingRepository->create([
                'car_id' => $car->id,
                'user_id' => $userId,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'pickup_location_id' => $pickupLocationId,
                'dropoff_location_id' => $dropoffLocationId,
                'daily_rate' => $car->daily_rate,
                'booking_policy_cost' => $policy ? $policy->cost : 0,
                'booking_policy_id' => $policy ? $policy->id : null,
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Cancel a booking
     *
     * @param int $bookingId
     * @param \App\Models\User $user
     */
    public function cancelBooking($booking, $user)
    {
        if ($booking->user->id !== $user->id) {
            return false;
        }

        // send a notification to the user
        // $user->notify(new BookingCancelled($booking)); example

        return $booking->delete();
    }

    /**
     * Update the pickup location of a booking
     *
     * @param \App\Models\Booking $bookingId
     * @param \App\Models\User $user
     * @param int $locationId
     */
    public function updatePickupLocation($booking, $user, $locationId)
    {
        // With more time I would have added a validation to check if the location is valid
        // and use policies to check if the user is allowed to update the booking
        if ($booking->user->id !== $user->id) {
            return false;
        }

        $booking->update([
            'pickup_location_id' => $locationId
        ]);

        return $booking;
    }

    /**
     * Calculate the total daily rate of a booking
     */
    public function calculateTotalDailyRate($car, $startDate, $endDate)
    {
        try {
            $carbonStartDate = Carbon::parse($startDate);
            $carbonEndDate = Carbon::parse($endDate);
            return ($car->daily_rate * $carbonStartDate->diffInDays($carbonEndDate));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception('Failed to calculate total daily rate');
        }
    }
}
