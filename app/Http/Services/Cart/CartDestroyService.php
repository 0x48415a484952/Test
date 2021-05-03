<?php

namespace App\Http\Services\Cart;

use App\Http\Services\Cart\Cart;
use App\Http\Traits\ApiResponseStatus;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProductRepositoryInterface;

class CartDestroyService
{
    use ApiResponseStatus;

    public function __construct(private Cart $cart, 
                                private ProductRepositoryInterface $productRepository)
    {
        
    }

    public function action()
    {
        $this->cart->setUser(Auth::user());
        $this->cart->delete($this->productRepository->id);
        return $this->JsonResponseSuccess('removed from the cart', 200);
    }
}