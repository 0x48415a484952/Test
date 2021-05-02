<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Services\Products\ProductIndexService;
use Illuminate\Http\Request;

class ProductIndexController extends Controller
{
    public function __construct(private Request $request, private ProductIndexService $productIndexService)
    {
        
    }

    public function __invoke()
    {
        return $this->ProductIndexService->action();
    }
}
