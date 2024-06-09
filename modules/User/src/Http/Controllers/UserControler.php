<?php

namespace modules\User\src\Http\Controllers;

use \App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use modules\User\src\Http\Requests\UserRequest;
use modules\User\src\Models\User;
use modules\User\src\Repositories\UserRepository;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\String\u;


class  UserControler extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $pageTitle = 'Quản lý người dùng';
        $allUser = $this->userRepository->getAll();
        return view('User::list', compact('pageTitle', 'allUser'));

    }

    public function data()
    {
        $users = $this->userRepository->getAllUser();
        return DataTables::of($users)
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d/m/Y H:i');
            })
            ->addColumn('edit', function ($user) {

                return ' <a href="' . route('admin.users.edit', $user) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($user) {
                return ' <a href="' . route('admin.users.delete', $user) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->toJson();
    }

    public function create()
    {
        $pageTitle = "Thêm người dùng";
        return view('User::add', compact('pageTitle'));
    }

    public function store(UserRequest $request)
    {
        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'group_id' => $request->group_id,
        ]);
        return redirect()->route('admin.users.index')->with('msg', __('User::messages.create.success'));
    }

    public function update(UserRequest $request, $user)
    {
        $data = $request->except(['_token', 'password']);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $this->userRepository->update($user, $data);
        return back()->with('msg', __('User::messages.update.success'));

    }

    public function edit($user)
    {
        $user = $this->userRepository->find($user);
        if ($user) {
            $pageTitle = 'Sửa người dùng';
            return view('User::edit', compact('user', 'pageTitle'));
        } else {
            return redirect()->route('admin.users.index');
        }
    }

    public function delete($user)
    {
        $this->userRepository->delete($user);
        return redirect()->route('admin.users.index')->with('msg', __('User::messages.delete.success'));
//    return "a";
    }

}


