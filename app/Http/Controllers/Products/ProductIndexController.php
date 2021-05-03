<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductIndexResource;
use App\Http\Services\Products\ProductIndexService;

class ProductIndexController extends Controller
{
    public function __construct(private ProductIndexService $productIndexService)
    {
        
    }

    public function __invoke()
    {
        return ProductIndexResource::collection($this->productIndexService->action());
    }
}
