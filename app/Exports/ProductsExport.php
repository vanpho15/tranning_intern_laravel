<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class ProductsExport implements FromCollection,  WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection

     */
    protected $products;
    public function __construct($products)
    {
        $this->products = $products;
    }
    public function collection()
    {
        return $this->products;
    }
    public function headings(): array
    {
        return ["ID", "Product name", "Product name kana", "Alias", "Content", "Amount", "Price", "Category ID", "Category Name", "Created at", "Updated at"];
    }
    public function map($products): array
    {
        return [
            $products->id,
            $products->name,
            $products->name_kana,
            $products->alias,
            $products->content,
            $products->amount,
            $products->price,
            $products->categories->id,
            $products->categories->name,
            $products->created_at,
            $products->updated_at
        ];
    }
}
