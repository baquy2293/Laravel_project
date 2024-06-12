<?php

namespace modules\Categories\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CategoriesRepositoryInterface extends RepositoryInterface
{
    public function getCategories();

    public function getAllCategories();

}

