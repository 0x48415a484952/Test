<?php

namespace App\Http\Services\SpecialPriceCalculator;


class SpecialFixedPriceCalculator extends AbstractSpecialPriceCalculator
{
    //ok this may seem a bit awkward but implemented it this way to work as a CoR
    //this way we can add more classes then just pass  each request to the other to handle
    //so this way it is future proof to have some kind of syntax like 4:%15 which we can
    //later parse it to be 15% on the total of the price for this specific product
    public function calculate($products)
    {
        $validator = 0;
        $products = json_decode($products,true);
        $item = $products['products'];
        foreach ($item as $key => $value) {
            $total = 0;
            $decodedRules = json_decode($item[$key]['special_price_rule'], true);
            krsort($decodedRules);
            $lastElementOfDecodedRules = end($decodedRules);
            $remainder = $item[$key]['quantity'];
            foreach ($decodedRules as $quantity => $specialPrice) {
                if (  
                    (($remainder % $quantity) !== 0
                    && $remainder > $quantity 
                    && is_int($specialPrice) )
                    ||
                    ($remainder % $quantity === 0
                    && $remainder >= $quantity 
                    && is_int($specialPrice))
                    ) {
                    $quotient = intval($remainder / $quantity);

                    $total += $quotient * $specialPrice;
                    $remainder = intval($remainder % $quantity);
                }   
                if ($remainder < $quantity
                && $lastElementOfDecodedRules === $specialPrice
                && is_int($specialPrice) ) {
                    $total += $remainder * $item[$key]['price'];
                } 
            }

            $item[$key]['total'] = $total;
            $validator++;
        }

        return $item;
        
        if ($validator !== count($item) - 1) {
            return parent::calculate($products);
        }
        
    }
}