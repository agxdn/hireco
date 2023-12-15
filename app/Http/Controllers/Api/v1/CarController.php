<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CarAllRequest;
use App\Services\CarService;
use App\Http\Controllers\Controller;

/**
 * Class CarController
 *
 * @property CarService $carService
 *
 */
class CarController extends Controller
{

    /**
     * CarController constructor.
     *
     * @param CarService $carService
     */
    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function all(CarAllRequest $request)
    {
        $status = $request->status;
        $from = $request->from;
        $to = $request->to;

        $response = $this->carService->allByStatus($status, $from, $to);

        return response()->json([
            'message' => '',
            'data' => $response,
            'status' => 'ok'
        ]);
    }
}
