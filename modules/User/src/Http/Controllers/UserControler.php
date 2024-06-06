<?php

namespace modules\User\src\Http\Controllers;

use \App\Http\Controllers\Controller;


class  UserControler extends Controller
{

    public function index()
    {
        $pageTitle = 'Quản lý người dùng';
        return view('User::list', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = "Thêm người dùng";
        return view('User::add');
    }


}


