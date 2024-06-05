<?php

namespace modules\User\src\Http\Controllers;

use \App\Http\Controllers\Controller;
use modules\User\src\Repositories\UserRepository;
use modules\User\src\Models\User;

class  UserControler extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('User::list');
    }
}

