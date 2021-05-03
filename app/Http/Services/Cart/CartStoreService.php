<?php

namespace App\Http\Services\Cart;

use App\Http\Services\Cart\Cart;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Traits\ApiResponseStatus;
use App\Repositories\ProductRepositoryInterface;

class CartStoreService
{
    use ApiResponseStatus;
    
    public function __construct(private Cart $cart, private ProductRepositoryInterface $productRepository)
    {
        
    }

    public function action(CartStoreRequest $request)
    {
        $this->cart->setUser(Auth::user());
        $this->cart->add($request->products);
        return $this->JsonResponseSuccess('added to the cart', 200);
    }

}