<?php

namespace App\Http\Services\Products;

use App\Repositories\ProductRepositoryInterface;


class ProductIndexService
{
    public function __construct(private ProductRepositoryInterface $product)
    {
        
    }
    public function action()
    {
        return $this->product->all();
    }
}