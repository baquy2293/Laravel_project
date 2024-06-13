<?php

namespace modules\Courses\src\Http\Controllers;

use \App\Http\Controllers\Controller;
use modules\Courses\src\Repositories\CoursesRepository;

use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use modules\Courses\src\Models\Course;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\String\u;


class  CoursesController extends Controller
{


    protected $coursesRepository;
public function __construct(CoursesRepository $coursesRepository)
{
    $this->coursesRepository = $coursesRepository;
}

    public function index()
    {
        $pageTitle = 'Quản lý Khóa học ';
        $allcours = $this->coursesRepository->getAll();
        return view('Courses::list', compact('pageTitle', 'allcours'));
    }

    public function data()
    {
        $courses = $this->coursesRepository->getAllcourse();
        return DataTables::of($courses)
            ->editColumn('created_at', function ($course) {
                return $course->created_at->format('d/m/Y H:i');
            })
            ->addColumn('edit', function ($course) {

                return ' <a href="' . route('admin.courses.edit', $course) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($course) {
                return ' <a href="' . route('admin.courses.delete', $course) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->toJson();
    }

    public function create()
    {
        $pageTitle = "Thêm khóa học";
        return view('Courses::add', compact('pageTitle'));
    }

    public function store(CoursesRequest $request)
    {
        $this->coursesRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'group_id' => $request->group_id,
        ]);
        return redirect()->route('admin.cours.index')->with('msg', __('Course::messages.create.success'));
    }

    public function update(CourseRequest $request, $course)
    {
        $data = $request->except(['_token', 'password']);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $this->coursesRepository->update($course, $data);
        return back()->with('msg', __('Course::messages.update.success'));

    }

    public function edit($course)
    {
        $course = $this->coursesRepository->find($course);
        if ($course) {
            $pageTitle = 'Sửa người dùng';
            return view('Course::edit', compact('course', 'pageTitle'));
        } else {
            return redirect()->route('admin.courses.index');
        }
    }

    public function delete($course)
    {
        $this->coursesRepository->delete($course);
        return redirect()->route('admin.courses.index')->with('msg', __('course::messages.delete.success'));
    }

}


