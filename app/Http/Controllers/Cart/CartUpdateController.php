<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartUpdateRequest;
use App\Http\Services\Cart\CartUpdateService;
use App\Http\Traits\ApiResponseStatus;

class CartUpdateController extends Controller
{
    
    public function __construct(private CartUpdateService $cartStoreService, private CartUpdateRequest $request)
    {
        
    }

    public function __invoke()
    {
        return $this->cartStoreService->action($this->request);
    }
}