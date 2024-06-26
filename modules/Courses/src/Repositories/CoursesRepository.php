<?php

namespace modules\Courses\src\Repositories;

use Illuminate\Support\Facades\Hash;
use modules\Courses\src\Models\Course;
use App\Repositories\BaseRepository;
use modules\Courses\src\Repositories\CoursesRepositoryInterface;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourses()
    {
        $data = $this->model->select('id', 'name', 'price', 'status', 'created_at');
        return $data;
    }

    public function getAllCategory()
    {
        $data = $this->getAll();
    }

    public function createCoursesCategory($course, $data)
    {
//        dd($course);
        $course->categories()->attach($data);
    }

    public function getRelatedCategories($couese)
    {
        return $couese->categories()->allRelatedIds()->toArray();
    }

    public function updateCoursesCatagory($course, $data)
    {
        $course->categories()->sync($data);
    }
    public function deleteCoursesCatagory($course){
        $course->categories()->detach();
    }


}
