<?php

namespace App\Services;

use App\Repositories\CarRepository;

/**
 * Class CarService
 *
 * @property CarRepository $carRepository
 *
 * @package App\Services
 */
class CarService
{

    /**
     * CarService constructor
     *
     * @return void
     */
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * Get all cars by status
     *
     * @param $status
     * @param $from
     * @param $to
     */
    public function allByStatus($status, $from, $to)
    {
        switch ($status) {
            case 'available':
                return $this->carRepository->allAvailable($from, $to);
            // case 'booked': example
            //     return $this->carRepository->allBooked($from, $to);
            default:
                return [];
        }
    }

    /**
     * Find a car
     *
     * @param $id
     */
    public function findCar($id)
    {
        return $this->carRepository->findOrFail($id);
    }
}
