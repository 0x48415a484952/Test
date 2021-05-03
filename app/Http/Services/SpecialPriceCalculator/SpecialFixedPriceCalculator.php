<?php

namespace App\Http\Services\SpecialPriceCalculator;


class SpecialFixedPriceCalculator extends AbstractSpecialPriceCalculator
{
    public function calculate($products)
    {
        // array:2 [
                //     8 => 350
                //     3 => 130
                //   ]


                //$item[$key] = // array:7 [
                //     "id" => 2
                //     "title" => "new product 2"
                //     "slug" => "some-slug-9"
                //     "description" => null
                //     "special_price_rule" => "{"3": 130, "8": 350}"
                //     "user_id" => 1
                //     "quantity" => 42
                //   ]

        $products = json_decode($products,true);
        $item = $products['products'];
        
        foreach ($item as $key => $value) {
            
            $counter = 0;
            $total = 0;
            $decodedRules = json_decode($item[$key]['special_price_rule'], true);
            
            krsort($decodedRules);
            $remainder = $item[$key]['quantity'];
            foreach ($decodedRules as $quantity => $specialPrice) {

                if ( ( ($remainder % $quantity) !== 0) 
                    && $remainder > $quantity 
                    && is_int($specialPrice) ) {

                    $quotient = intval($remainder / $quantity);

                    $total += $quotient * $specialPrice;
                    $remainder = intval($remainder % $quantity);
                    var_dump($total);
                    // continue;
                }

                

                if (count($decodedRules) - 1 === $counter 
                && $remainder < $quantity
                && is_int($specialPrice) ) {

                    $total += $remainder * $item[$key]['price'];
                    var_dump($total);
                    // continue;
                } 
                if ( (($remainder % $quantity) === 0) 
                    && $remainder >= $quantity 
                    && is_int($specialPrice) ) {

                    $total += ($remainder / $quantity ) * $specialPrice;
                    $remainder = intval($remainder % $quantity);
                    // var_dump($total);
                    
                } else {
                    return parent::calculate($products);
                } 
                $counter++; 
                var_dump($total);
                
                
            }
            // $item[$key]['total'] = $total;
            // dd($total);
            
        }
        
        
        // dd($item[0]['total'], $item[1]['total']);
        
        
    }
}