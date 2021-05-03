<?php

namespace App\Http\Services\SpecialPriceCalculator;

use App\Http\Services\Cart\Cart;


abstract class AbstractSpecialPriceCalculator  implements SpecialPriceCalculatorInterface
{
    private $next;

    public function next(SpecialPriceCalculatorInterface $specialPriceParser): SpecialPriceCalculatorInterface
    {
        $this->next = $specialPriceParser;

        return $specialPriceParser;
    }


    public function calculate($products)
    {
        if ($this->next) {
            $this->next->calculate($products);
        }

        return $products;
    }
    
}
