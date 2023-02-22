<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function handleAdd($request);
    public function handleEdit($id, $request);
    public function getCategories();
    public function destroy($request);
    public function getProductSearch($request);
    public function exportProductSearch($request);
    public function putSession($request);
    public function import($request);
}
