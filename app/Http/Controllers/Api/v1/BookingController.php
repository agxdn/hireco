<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\BookingStoreRequest;
use App\Services\BookingPolicyService;
use App\Services\BookingService;
use App\Services\CarService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class BookingController
 *
 * @property BookingService $bookingService
 * @property BookingPolicyService $bookingPolicyService
 * @property CarService $carService
 *
 * @package App\Http\Controllers
 */
class BookingController extends Controller
{
    /**
     * BookingController constructor.
     *
     * @param BookingService $bookingService
     * @param CarService $carService
     */
    public function __construct(
        BookingService $bookingService,
        CarService $carService,
        BookingPolicyService $bookingPolicyService
    ) {
        $this->bookingService = $bookingService;
        $this->bookingPolicyService = $bookingPolicyService;
        $this->carService = $carService;
    }

    /**
     * Create a booking
     */
    public function createBooking(BookingStoreRequest $request)
    {
        $carId = $request->car_id;
        $user = $request->user();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $pickupLocationId = $request->pickup_location_id;
        $dropoffLocationId = $request->dropoff_location_id;
        $age = $user->dob->age;

        // Find car
        $car = $this->carService->findCar($carId);

        // Calculate total rental cost example
        // $cost = $this->bookingService->calculateTotalDailyRate($car, $startDate, $endDate); // Calculate total rental cost

        // Find the booking policy
        $policy = $this->bookingPolicyService->findPolicyByAge($age);

        $response = $this->bookingService->bookCar(
            $car,
            $user->id,
            $startDate,
            $endDate,
            $pickupLocationId,
            $dropoffLocationId,
            $policy
        );

        if (!$response) {
            return response()->json([
                'message' => 'Failed to book car',
                'data' => null,
                'status' => 'failed'
            ]);
        }
        return response()->json([
            'message' => 'Car booked successfully',
            'data' => $response,
            'status' => 'ok'
        ]);
    }

    /**
     * Cancel a booking
     */
    public function cancelBooking(Request $request)
    {
        $booking = $request->booking;
        $user = $request->user();

        $response = $this->bookingService->cancelBooking($booking, $user);
        if ($response === false) {
            return response()->json([
                'message' => 'Failed to cancel booking',
                'data' => null,
                'status' => 'failed'
            ]);
        }

        return response()->json([
            'message' => 'Booking cancelled successfully',
            'data' => null,
            'status' => 'ok'
        ]);
    }

    /**
     * Update pickup location for a booking
     */
    public function updateBookingPickupLocation(Request $request)
    {
        $booking = $request->booking;
        $user = $request->user();
        $pickupLocationId = $request->pickup_location_id;

        $response = $this->bookingService->updatePickupLocation(
            $booking,
            $user,
            $pickupLocationId
        );

        if ($response === false) {
            return response()->json([
                'message' => 'Failed to update booking',
                'data' => null,
                'status' => 'failed'
            ]);
        }

        return response()->json([
            'message' => 'Updated pickup location successfully',
            'data' => null,
            'status' => 'ok'
        ]);
    }
}
