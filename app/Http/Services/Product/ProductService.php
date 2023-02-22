<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductService
{
    public function getCategories()
    {
        return Category::where('del_flg', config('constants.global.del_flg'))->get();
    }
}
