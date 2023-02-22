<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use Illuminate\Support\Facades\DB;
use App\Imports\ProductsImport;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Product::class;
    }

    protected function uploadimg($request, $lastInsertID)
    {
        if ($request->hasFile('image_link')) {
            try {
                $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis');
                $random = Str::random(7);
                $file = $request->file('image_link');
                $ext = $request->file('image_link')->extension();
                $filename = $dt . '_' . $lastInsertID . '_' . $random . '.' . $ext;
                $pathFull = 'image/products';
                $request->file('image_link')->storeAs('public/' . $pathFull, $filename);
                $find_user = Product::find($lastInsertID);
                $find_user->image_link = $pathFull . '/' . $filename;
                $find_user->save();
            } catch (\Exception $error) {
                return false;
            }
        }
    }
    public function handleAdd($request)
    {
        try {
            $create = $this->model->create([
                'name' => request()->input('name'),
                'name_kana' => request()->input('name_kana'),
                'alias' => Str::slug(request()->input('alias'), '-'),
                'content' => request()->input('content'),
                'amount' => request()->input('amount'),
                'price' => request()->input('price'),
                'category_id' => request()->input('category_id'),
                'created_by' => Auth::id()
            ]);
            $lastInsertID = $create->id;
            $this->uploadimg($request, $lastInsertID);
            session()->flash('success', 'Saved successfully.');
        } catch (\Exception $err) {
            session()->flash('error', 'Save failed.');
            return false;
        }
        return true;
    }
    public function handleEdit($id, $request)
    {
        try {
            DB::beginTransaction();
            $this->update($id, [
                'name' => request()->input('name'),
                'name_kana' => request()->input('name_kana'),
                'alias' => Str::slug(request()->input('alias'), '-'),
                'content' => request()->input('content'),
                'amount' => request()->input('amount'),
                'price' => (int) request()->input('price'),
                'category_id' => request()->input('category_id'),
                'updated_by' => Auth::id()
            ]);
            $this->uploadimg($request, $id);
            session()->flash('success', 'Saved successfully.');
            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();
            session()->flash('error', 'Save failed.');
            return  false;
        }
        return  true;
    }
    public function getCategories()
    {
        return Product::with('categories')->where('del_flg', config('constants.global.del_flg'));
    }
    public function destroy($request)
    {
        $product = Product::where('id', $request->input('id'));
        if ($product) {
            $product->update(['deleted_at' => now(), 'deleted_by' => Auth::user()->id, 'del_flg' => 1]);
            return true;
        } else {
            return false;
        }
    }
    public function putSession($request)
    {
        $data = [
            'name' => $request->input('name'),
            'name_kana' => $request->input('name_kana'),
            'alias' => $request->input('alias'),
            'amount' => $request->input('amount'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ];
        session()->put('products_search', $data);
        return session('products_search');
    }
    public function getProductSearch($SesionSearch)
    {
        if (!empty($SesionSearch)) {
            $products = Product::query()->where('del_flg', 0);
            if (!empty($SesionSearch['name_kana'])) {
                $products = $products->where('name_kana', 'LIKE', '%' . $SesionSearch['name_kana'] . '%');
            }
            if (!empty($SesionSearch['name'])) {
                $products = $products->where('name', 'LIKE', '%' . $SesionSearch['name'] . '%');
            }
            if (!empty($SesionSearch['alias'])) {
                $products = $products->where('alias', 'LIKE', '%' . $SesionSearch['alias'] . '%');
            }
            if (!empty($SesionSearch['amount'])) {
                $products = $products->where('amount', '=', $SesionSearch['amount']);
            }
            if (!empty($SesionSearch['price'])) {
                $products = $products->where('price', '=', $SesionSearch['price']);
            }
            if (!empty($SesionSearch['category_id'])) {
                $products = $products->where('category_id', '=', $SesionSearch['category_id']);
            }
            return $products;
        }
    }
    public function exportProductSearch($SesionSearch)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis');
        $filename = $dt . '_product.csv';
        if (!empty($SesionSearch)) {
            $products = $this->getProductSearch($SesionSearch)->with('categories')->get();
        } else {
            $products = $this->model->where('del_flg', config('constants.global.del_flg'))->get();
        }
        return Excel::download(new ProductsExport($products), $filename);
    }
    public function import($request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis');
        (new ProductsImport)->import($request->file('file')->storeAs('files', $dt . '_product.csv'), null, \Maatwebsite\Excel\Excel::CSV);
    }
}
