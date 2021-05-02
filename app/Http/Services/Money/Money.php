<?php

namespace App\Http\Services\Money;

use Money\Currency;
use Money\Money as BaseMoney;
use NumberFormatter;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class Money
{
    protected $money;

    public function __construct($value)
    {
        $this->money = new BaseMoney($value, new Currency('USD'));
    }

    public function amount()
    {
        return $this->money->getAmount();
    }

    public function formatted()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('en_US', NumberFormatter::CURRENCY, ''),
            new ISOCurrencies()
        );

        $amount = $this->amount();
        $amount = number_format($amount, 0, "/", ",");
        $amount = (string)$amount;
        return $amount;
    }

    public function add(Money $money)
    {
        $this->money = $this->money->add($money->instance());
        return $this;
    }

    public function instance()
    {
        return $this->money;
    }
}
