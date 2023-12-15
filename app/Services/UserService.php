<?php

namespace App\Services;

use App\Models\User;

/**
 * Class UserService
 *
 */
class UserService
{

    /**
     * @var User
     */
    protected $model;

    /**
     * UserService constructor
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Create an API token for a user
     *
     * @param User $user
     * @return string
     */
    public function createApiToken($user) : string
    {
        return $user->createToken('api-token')->plainTextToken;
    }
}
