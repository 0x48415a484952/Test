<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Services\Cart\CartStoreService;

class CartStoreController extends Controller
{
    public function __construct(private CartStoreService $cartStoreService, private CartStoreRequest $request)
    {
        
    }

    public function __invoke()
    {
        return $this->cartStoreService->action($this->request);
    }
}