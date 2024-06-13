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
        return $this->model->select('id', 'name', 'price', 'status', 'created_at');
    }

}
