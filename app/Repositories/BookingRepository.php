<?php

namespace App\Repositories;

use App\Models\Booking;

/**
 * Class BookingRepository
 *
 */
class BookingRepository
{

    /**
     * @var Booking
     */
    protected $model;

    /**
     * BookingRepository constructor
     *
     * @return void
     */
    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    /**
     * Fetch all bookings
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create a booking
     *
     * @param array $data
     * @return Booking
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Find a booking
     *
     * @param int $bookingId
     */
    public function find($bookingId)
    {
        return $this->model->find($bookingId);
    }

    /**
     * Find a booking or fail
     *
     * @param int $bookingId
     */
    public function findOrFail($bookingId)
    {
        return $this->model->findOrFail($bookingId);
    }
}
