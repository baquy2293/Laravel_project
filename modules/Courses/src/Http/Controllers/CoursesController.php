<?php

namespace modules\Courses\src\Http\Controllers;

use \App\Http\Controllers\Controller;
use modules\Categories\src\Repositories\CategoriesRepository;
use modules\Courses\src\Repositories\CoursesRepository;

use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use modules\Courses\src\Models\Course;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\String\u;
use modules\Courses\src\Http\Requests\CoursesRequest;
use Carbon\Carbon;

class  CoursesController extends Controller
{


    protected $coursesRepository;
    protected $categoriesRepository;

    public function __construct(CoursesRepository $coursesRepository, CategoriesRepository $categoriesRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->categoriesRepository = $categoriesRepository;
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
        $categories = $this->categoriesRepository->getAllCategories();
        return view('Courses::add', compact('pageTitle', 'categories'));
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

        $course = $this->coursesRepository->create($courses);
        $categories = $this->getCategories($courses);

        $this->coursesRepository->createCoursesCategory($course, $categories);
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
        $categories = $this->getCategories($courses);
        $course = $this->coursesRepository->find($course);

        $this->coursesRepository->updateCoursesCatagory($course, $categories);


        return back()->with('msg', __('Courses::messages.update.success'));

    }

    public function edit($course)
    {
        $course = $this->coursesRepository->find($course);

        $category_id = $this->coursesRepository->getRelatedCategories($course);

        if ($course) {
            $pageTitle = 'Sửa Khoá học';
            $categories = $this->categoriesRepository->getAllCategories();
            return view('Courses::edit', compact('course', 'pageTitle', 'categories', 'category_id'));
        } else {
            return redirect()->route('admin.courses.index');
        }
    }

    public function delete($course)
    {
        $course = $this->coursesRepository->find($course);
        $this->coursesRepository->deleteCoursesCatagory($course);
        $this->coursesRepository->delete($course->id);
        return redirect()->route('admin.courses.index')->with('msg', __('Courses::messages.delete.success'));
    }

    public function getCategories($courses = null)
    {
        $categories = [];
        foreach ($courses['categories'] as $category) {
            $categories[$category] = [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()];
        }
        return $categories;

    }

}


