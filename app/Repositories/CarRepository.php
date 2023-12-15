<?php

namespace App\Repositories;

use App\Models\Car;

/**
 * Class CarRepository
 *
 */
class CarRepository
{

    /**
     * @var Car
     */
    protected $model;

    /**
     * CarRepository constructor
     *
     * @return void
     */
    public function __construct(Car $model)
    {
        $this->model = $model;
    }

    /**
     * Get all available cars which are not booked
     */
    public function allAvailable($from, $to)
    {
        return $this->model->notBooked($from, $to)->get();
    }

    /**
     * Get all booked cars
     */
    public function allBooked($from, $to)
    {
        return $this->model->booked($from, $to)->get();
    }

    /**
     * Find a car.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}
