<?php

namespace App\Services;

use App\Repositories\BookingPolicyRepository;
use Exception;
use Log;

/**
 * Class BookingPolicyService
 *
 * @property BookingPolicyRepository $bookingPolicyRepository
 *
 * @package App\Services
 */
class BookingPolicyService
{

    /**
     * BookingPolicyService constructor
     *
     * @return void
     */
    public function __construct(BookingPolicyRepository $bookingPolicyRepository)
    {
        $this->bookingPolicyRepository = $bookingPolicyRepository;
    }

    /**
     * Book a car
     */
    public function findPolicyByAge($age)
    {
        if ($age < 21) {
            return $this->bookingPolicyRepository->findByName('age_below_21');
        } elseif ($age < 25) {
            return $this->bookingPolicyRepository->findByName('age_below_25');
        }
        return null;
    }
}
