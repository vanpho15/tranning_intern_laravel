<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;
use App\Http\Requests\Category\AddRequest;
use App\Http\Requests\Category\EditRequest;
use App\Http\Common\Paginate;


class CategoryController extends Controller
{
    protected $CategoryService;
    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }
    public function add()
    {
        return view('admin.screen.category.category-add', [
            'title' => 'Categories Add'
        ]);
    }
    public function handleAdd(AddRequest $request)
    {
        $this->CategoryService->handleAdd($request);
        return redirect()->back();
    }
    public function edit($id)
    {
        return view('admin.screen.category.category-edit', [
            'title' => 'Users Edit',
            'category' => $this->CategoryService->getCategory($id)
        ]);
    }
    public function handleEdit(EditRequest $request, $id)
    {
        $this->CategoryService->handleEdit($request, $id);
        return redirect()->back();
    }
    public function listCategory()
    {

        return view('admin.screen.category.category-list', [
            'title' => 'User Search',
            'categories' => Paginate::paginate($this->CategoryService->getCategories(), config('constants.global.pagination_records')),
        ]);
    }
    public function destroy(Request $request)
    {
        $result = $this->CategoryService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }
    public function search(Request $request)
    {
        $SesionSearch = $this->CategoryService->putSession($request);
        return view('admin.screen.category.category-list', [
            'title' => 'Category Search',
            'categories' => Paginate::paginate($this->CategoryService->getCategorySearch($SesionSearch), config('constants.global.pagination_records')),
        ]);
    }
    public function forgetSessionSearch(Request $request)
    {
        $request->session()->forget('categories_search');
        return view('admin.screen.category.category-list', [
            'title' => 'Category Search',
            'categories' => Paginate::paginate($this->CategoryService->getCategorySearch($request), config('constants.global.pagination_records')),
        ]);
    }
}
