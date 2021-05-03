<?php

namespace App\Http\Services\Cart;

use App\Http\Services\SpecialPriceCalculator\SpecialFixedPriceCalculator;

class Cart
{
    //referencing the authenticated user
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }


    public function setUser($user)
    {
        $this->user = $user;
    }

    //returns a collection of products in the user_cart table related to the authenticated user
    public function products()
    {
        return $this->user->cart;
    }

    public function refreshUserCart()
    {
        return $this->user->cart()->refresh();
    }

    //add products to cart_user table
    public function add($products)
    {
        $this->user->cart()->syncWithoutDetaching(
            $this->getStorePayload($products)
        );
    } 

    //update(reduce) quantity of the user_cart
    public function update($productId, $quantity)
    {
        $this->user->cart()->updateExistingPivot($productId, [
            'quantity' => $quantity 
        ]);
    } 

    //remove product from user_cart
    public function delete($productId)
    {
        $this->user->cart()->detach($productId);
    }

    protected function getStorePayload($products) 
    {
        return collect($products)->keyBy('id')->map(function($product) {
            return [
                'quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id'])
            ];
        })->toArray();
    }

    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->user->cart->where('id', $productId)->first()) {
            return $product->pivot->quantity;
        }
        return 0;
    }

    public function subtotal()
    {
        $userCart = $this->products();
        $priceCalculator = new SpecialFixedPriceCalculator();
        return $priceCalculator->calculate($this->user->cart()->with('products.special_price_rule'), $userCart);
    }
}
