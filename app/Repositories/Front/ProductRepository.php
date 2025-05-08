<?php

namespace App\Repositories\Front;

use App\Repositories\Front\Interfaces\ProductRepositoryInterface;
use App\Models\DimPlant;

class ProductRepository implements ProductRepositoryInterface
{
    public function findAll(array $options = [])
    {
        return DimPlant::paginate($options['per_page'] ?? 15);
    }

    public function findById($id)
    {
        return DimPlant::findOrFail($id);
    }

    public function delete($id)
    {
        $product = DimPlant::findOrFail($id);
        return $product->delete();
    }
}