<?php

namespace App\Http\Services\Cart;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Cart\CartResource;
use App\Http\Resources\Cart\CartProductResource;
use App\Http\Services\SpecialPriceCalculator\SpecialFixedPriceCalculator;

class CartIndexService
{
    public function __construct(private Cart $cart)
    {
        
    }

    public function action()
    {
        $user = Auth::user();
        $this->cart->setUser($user);
        $priceCalculator = new SpecialFixedPriceCalculator();
        $productsInCart = (new CartResource($user));
        return $priceCalculator->calculate($productsInCart->toJson());
    }
}