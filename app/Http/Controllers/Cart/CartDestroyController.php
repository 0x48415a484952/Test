<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartUpdateRequest;
use App\Http\Services\Cart\CartDestroyService;
use App\Http\Services\Cart\CartUpdateService;

class CartDestroyController extends Controller
{
    public function __construct(private CartDestroyService $cartStoreService)
    {
        
    }

    public function __invoke()
    {
        return $this->cartStoreService->action();
    }
}