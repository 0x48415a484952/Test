<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

/**
* Class UserRepository
* @package App\Repositories
*/
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(user $model)
    {
        $this->model = $model;
    }


    /**
     * UserRepository cart()
     *
     */
    public function cart()
    {
        return $this->model->cart();
    }
}