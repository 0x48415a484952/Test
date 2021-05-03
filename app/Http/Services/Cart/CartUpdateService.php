<?php

namespace App\Http\Services\Cart;

use App\Http\Services\Cart\Cart;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Cart\CartUpdateRequest;
use App\Http\Traits\ApiResponseStatus;
use App\Repositories\ProductRepositoryInterface;

class CartUpdateService
{
    use ApiResponseStatus;

    public function __construct(private Cart $cart, 
                                private ProductRepositoryInterface $productRepository)
    {
        
    }

    public function action(CartUpdateRequest $request)
    {
        $this->cart->setUser(Auth::user());
        $product = $this->productRepository->find($request->id);
        $this->cart->update($product, $request->quantity);
        return $this->JsonResponseSuccess('updated the quantity of the cart', 200);
    }
  
}