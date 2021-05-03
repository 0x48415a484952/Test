<?php

namespace App\Http\Services\SpecialPriceCalculator;

use App\Http\Services\Cart\Cart;

interface SpecialPriceCalculatorInterface
{
    public function calculate(string $rules, $cart);

    public function next(SpecialPriceCalculatorInterface $nextParser): SpecialPriceCalculatorInterface;
}