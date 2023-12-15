<?php

namespace App\Repositories;

use App\Models\BookingPolicy;

/**
 * Class BookingPolicyRepository
 *
 */
class BookingPolicyRepository
{

    /**
     * @var BookingPolicy
     */
    protected $model;

    /**
     * BookingPolicyRepository constructor
     *
     * @return void
     */
    public function __construct(BookingPolicy $model)
    {
        $this->model = $model;
    }

    /**
     * Find a booking policy by name
     *
     * @param string $name
     */
    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }

    /**
     * Find a booking policy or fail
     *
     * @param int $bookingId
     */
    public function findOrFail($bookingId)
    {
        return $this->model->findOrFail($bookingId);
    }
}
