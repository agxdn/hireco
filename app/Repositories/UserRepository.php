<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 *
 */
class UserRepository
{

    /**
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Find a user
     *
     * @param int $userId
     */
    public function find($userId)
    {
        return $this->model->find($userId);
    }
}
