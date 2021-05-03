<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Products\ProductIndexResource;
use App\Http\Services\SpecialPriceCalculator\SpecialFixedPriceCalculator;


class CartProductResource extends ProductIndexResource
{
    public function toArray($request)
    {
        // $priceCalculator = new SpecialFixedPriceCalculator();
        // $priceCalculator->calculate($this->toArray($request));

        return array_merge(parent::toArray($request), [
            'price' => $this->price,
            'user_id' => $this->pivot->user_id,
            'quantity' => $this->pivot->quantity,
            'special_price_rule' => $this->special_price_rule
        ]);
        
    }
}
