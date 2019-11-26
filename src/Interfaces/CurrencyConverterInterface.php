<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Interfaces;

interface CurrencyConverterInterface
{
    /**
     * Return the computed value based on it's difference between currencies.
     */
    public function convert(string $currency, string $value): string;
}
