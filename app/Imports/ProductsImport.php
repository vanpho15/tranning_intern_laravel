<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Rules\CheckMax;
use App\Rules\CheckNumber;
use Config\Constants\Messages;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Rules\CheckAlphaNum;
use Illuminate\Support\Str;



HeadingRowFormatter::default('none');

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, WithUpserts
{
    use Importable;
    protected $categories;
    protected $product;
    public function __construct()
    {
        //QUERY UNTUK MENGAMBIL SELURUH DATA USER
        $this->categories = Category::select('id', 'name')->get();
        $this->product = Product::select('id', 'del_flg');
    }

    public function rules(): array
    {

        return [
            'Product name' => ['required', new CheckMax('Product name', config('constants.global.checkmax_100'))],
            'Product name kana' => ['required', new CheckMax('Product name kana', config('constants.global.checkmax_100'))],
            'Alias' => ['required', new CheckMax('Alias', config('constants.global.checkmax_100')), new CheckAlphaNum('Alias')],
            'Content' => ['required', new CheckMax('Content', 2000)],
            'Amount' => [new CheckMax('Amount', 6), new CheckNumber('Amount')],
            'Price' => [new CheckMax('Price', 20), new CheckNumber('Price')],
            'Category name' => [new CheckMax('Category name', config('constants.global.checkmax_100'))],
        ];
    }
    public function customValidationMessages()
    {
        return [
            'Product name.required' => Messages::getMessage('E001', ['Product name']),
            'Product name kana.required' => Messages::getMessage('E001', ['Product name kana']),
            'Alias.required' => Messages::getMessage('E001', ['Alias']),
            'Content.required' => Messages::getMessage('E001', ['Content']),
        ];
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['Deleted'] == 'Y') {
            return $this->product->where('id', $row['ID'])->update(['deleted_at' => now(), 'deleted_by' => Auth::user()->id, 'del_flg' => 1]);
        }
        if ($row['Category ID'] != '') {
            $categories = $this->categories->where('id', $row['Category ID'])->first();
            if ($categories) {
                $category_id = $categories->id;
            } else {
                $category = Category::create([
                    'id' => $row['Category ID'],
                    'name' => $row['Category name'],
                    'created_by' => Auth::id()
                ]);
                $category_id = $category->id;
            }
        }
        if ($row['Category ID'] == '' && $row['Category name'] != '') {
            $category = Category::create([
                'name' => $row['Category name'],
                'created_by' => Auth::id()
            ]);
            $category_id = $category->id;
        }
        return new Product([
            'id' => $row['ID'],
            'name' => $row['Product name'],
            'name_kana' => $row['Product name kana'],
            'alias' => Str::slug($row['Alias'], '-'),
            'content' => $row['Content'],
            'amount' => $row['Amount'],
            'price' => $row['Price'],
            'category_id' => $category_id,
        ]);
    }
    public function uniqueBy()
    {
        return 'id';
    }
}
