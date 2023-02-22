<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\AddRequest;
use App\Http\Requests\Product\EditRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Common\Paginate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Product\ImportRequest;


class ProductController extends Controller
{
    protected $ProductRepositoryInterface;
    protected $CategoryRepositoryInterface;

    public function __construct(ProductRepositoryInterface $ProductRepositoryInterface, CategoryRepositoryInterface $CategoryRepositoryInterface)
    {
        $this->ProductRepositoryInterface = $ProductRepositoryInterface;
        $this->CategoryRepositoryInterface = $CategoryRepositoryInterface;
    }
    public function add()
    {
        return view('admin.screen.product.product-add', [
            'title' => 'Product Add',
            'category' => $this->CategoryRepositoryInterface->getCategories()
        ]);
    }
    public function handleAdd(AddRequest $request)
    {
        $this->ProductRepositoryInterface->handleAdd($request);
        return redirect()->back();
    }
    public function edit($id)
    {
        return view('admin.screen.product.product-edit', [
            'title' => 'Product Edit',
            'product' => $this->ProductRepositoryInterface->find($id),
            'category' => $this->CategoryRepositoryInterface->getCategories()
        ]);
    }
    public function handleEdit($id, EditRequest $request)
    {
        $this->ProductRepositoryInterface->handleEdit($id, $request);
        return redirect()->back();
    }
    public function listProduct()
    {
        return view('admin.screen.product.product-list', [
            'title' => 'Product Search',
            'products' => Paginate::paginate($this->ProductRepositoryInterface->getCategories(), config('constants.global.pagination_records')),
            'category' => $this->CategoryRepositoryInterface->getCategories()

        ]);
    }
    /**
     * destroy
     * @param $request
     */
    public function destroy(Request $request)
    {
        $result = $this->ProductRepositoryInterface->destroy($request);
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
        $SesionSearch = $this->ProductRepositoryInterface->putSession($request);
        return view('admin.screen.product.product-list', [
            'title' => 'Product Search',
            'products' => Paginate::paginate($this->ProductRepositoryInterface->getProductSearch($SesionSearch), config('constants.global.pagination_records')),
            'category' => $this->CategoryRepositoryInterface->getCategories()
        ]);
    }
    public function forgetSessionSearch(Request $request)
    {
        $request->session()->forget('products_search');
        return view('admin.screen.product.product-list', [
            'title' => 'Product Search',
            'products' => Paginate::paginate($this->ProductRepositoryInterface->getProductSearch($request), config('constants.global.pagination_records')),
            'category' => $this->CategoryRepositoryInterface->getCategories()
        ]);
    }
    public function export(Request $request)
    {
        $SesionSearch = session('products_search');
        return $this->ProductRepositoryInterface->exportProductSearch($SesionSearch);
    }
    public function import(ImportRequest $request)
    {
        if ($request->hasFile('file')) {
            $this->ProductRepositoryInterface->import($request);
            return redirect()->back();
        } else {
            session()->flash('error', 'File does not exist.');
            return redirect()->back();
        }
    }
}
