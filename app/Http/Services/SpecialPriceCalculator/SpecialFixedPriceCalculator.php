<?php

namespace App\Http\Services\SpecialPriceCalculator;

use App\Http\Services\Cart\Cart;

class SpecialFixedPriceCalculator extends AbstractSpecialPriceCalculator
{
    public function calculate(string $rules, $cart)
    {
        $decodedRules = json_decode($rules);
        krsort($decodedRules);

        foreach ($cart as $key => $item) {
            foreach ($decodedRules as $quantity => $specialPrice) {

                if ( (($item['quantity'] % $quantity) !== 0) 
                    && $item['quantity'] > $quantity 
                    && is_int($specialPrice) ) {

                    $quotient = intval($item['quantity'] / $quantity);
                    $cart[$key]['total'] += $quotient * $specialPrice;
                }


                if ( (($item['quantity'] % $quantity) === 0) 
                    && $item['quantity'] >= $quantity 
                    && is_int($specialPrice) ) {

                    $cart[$key]['total'] += ($item['quantity'] / $quantity ) * $specialPrice;
                    break;
                } 


                if (is_int($specialPrice)) {
                    $item['quantity'] = $item['quantity'] % $quantity;
                } else {
                    return parent::calculate($rules, $cart);
                }
            }
        }
        
    }
}