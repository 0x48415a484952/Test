<?php

namespace App\Http\Services\SpecialPriceCalculator;

use App\Http\Services\Cart\Cart;

interface SpecialPriceCalculatorInterface
{
    public function calculate($products);

    public function next(SpecialPriceCalculatorInterface $nextParser): SpecialPriceCalculatorInterface;
}