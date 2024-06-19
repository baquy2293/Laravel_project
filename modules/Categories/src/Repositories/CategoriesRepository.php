<?php


namespace modules\Categories\src\Repositories;

use modules\Categories\src\Models\Categories;
use App\Repositories\BaseRepository;
use modules\Categories\src\Models\Category;
use modules\Categories\src\Repositories\CategoriesRepositoryInterface;


class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getCategories()
    {
        return $this->model->with('subCategories')->whereParentId(0)->select('id', 'name', 'slug', 'parent_id', 'created_at')->latest('created_at');

    }

    public function getAllCategories()
    {
        return $this->getAll();
    }


}
