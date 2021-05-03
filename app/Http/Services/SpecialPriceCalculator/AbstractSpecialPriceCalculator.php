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


    public function calculate(string $rules, $cart)
    {
        if ($this->next) {
            $this->next->calculate($rules, $cart);
        }

        return $cart;
    }
    
}
