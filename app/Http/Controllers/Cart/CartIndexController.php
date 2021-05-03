<?php

namespace App\Http\Controllers\Cart;

use Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Cart\CartIndexService;

class CartIndexController extends Controller
{
    public function __construct(private CartIndexService $cartIndexService)
    {
        
    }

    public function __invoke()
    {
        return $this->cartIndexService->action();
    }
}