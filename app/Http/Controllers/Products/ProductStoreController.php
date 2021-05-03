<?php

namespace App\Http\Controllers\Products;


use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Services\Products\ProductStoreService;

class ProductStoreController extends Controller
{
    public function __construct(private ProductStoreRequest $request, private ProductStoreService $productStoreService)
    {
        
    }

    public function __invoke()
    {
        return $this->productStoreService->action($this->request);
    }
}
