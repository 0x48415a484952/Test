<?php

namespace App\Http\Traits;

use App\Http\Services\Money\Money;

trait HasPrice
{

    public function getPriceAttribute($value)
    {
        return new Money($value);
    }

    public function getFormattedPriceAttribute()
    {
        return $this->price->formatted();
    }
}
