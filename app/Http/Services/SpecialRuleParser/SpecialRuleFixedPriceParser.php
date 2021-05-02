<?php

namespace App\Http\Services\SpecialRuleParser;

class SpecialRuleFixed implements SpecicalRuleParser
{
    protected $rules = [];

    public function parser($json)
    {
        $specialFixedPriceRules = json_decode($json);

        dd($specialFixedPriceRules);

        foreach($specialFixedPriceRules as $count => $price) {
            
        }
    }
}