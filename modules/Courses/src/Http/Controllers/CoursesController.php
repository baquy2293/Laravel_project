<?php

namespace modules\Courses\src\Http\Controllers;

use \App\Http\Controllers\Controller;
use modules\Courses\src\Repositories\CoursesRepository;

use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use modules\Courses\src\Models\Course;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\String\u;
use modules\Courses\src\Http\Requests\CoursesRequest;


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
        $courses = $this->coursesRepository->getAllCourses();
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
            ->editColumn('price', function ($course) {
                if ($course->price) {
                    $price = number_format($course->price) . 'đ';
                } else {
                    $price = "Miễn phí ";
                }
                return $price;
            })
            ->addColumn('status', function ($course) {
                if ($course->status) {
                    return "Đã ra mắt";
                } else {
                    return "Chưa ra mắt";
                }
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

        $courses = $request->except(['_token']);
        if (!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }

        if (!$courses['price']) {
            $courses['price'] = 0;
        }
        $this->coursesRepository->create($courses);
        return redirect()->route('admin.courses.index')->with('msg', __('Courses::messages.create.success'));
    }

    public function update(CoursesRequest $request, $course)
    {
        $courses = $request->except(['_token']);
        if (!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }

        if (!$courses['price']) {
            $courses['price'] = 0;
        }

        $this->coursesRepository->update($course, $courses);

        return back()->with('msg', __('Courses::messages.update.success'));

    }

    public function edit($course)
    {
        $course = $this->coursesRepository->find($course);
        if ($course) {
            $pageTitle = 'Sửa người dùng';
            return view('Courses::edit', compact('course', 'pageTitle'));
        } else {
            return redirect()->route('admin.courses.index');
        }
    }

    public function delete($course)
    {
        $this->coursesRepository->delete($course);
        return redirect()->route('admin.courses.index')->with('msg', __('Courses::messages.delete.success'));
    }

}


