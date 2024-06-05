<?php

namespace modules\User\src\Repositories;

use modules\User\src\Models\User;
use App\Repositories\BaseRepository;
use modules\User\src\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUsers($limit=10)
    {
        return $this->model->paginate($limit)->get();
    }


}
