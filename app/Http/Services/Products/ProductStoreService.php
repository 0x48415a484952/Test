<?php

namespace App\Http\Services\Products;

use App\Http\Requests\Products\ProductStoreRequest;
use App\Repositories\ProductRepositoryInterface;


class ProductStoreService
{
    public function __construct(private ProductRepositoryInterface $product)
    {
        
    }
    public function action(ProductStoreRequest $request)
    {
        $product = $this->product->create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'special_price_rule' => $request->special_price_rule
        ]);
        return $product;
    }
}