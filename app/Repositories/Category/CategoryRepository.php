<?php

namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;
use App\Models\Category;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Category::class;
    }
    public function getCategories()
    {
        return Category::where('del_flg', config('constants.global.del_flg'))->get();
    }
}
