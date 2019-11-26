<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Interfaces;

interface CurrencyAwareInterface
{
    /**
     * @const string
     */
    const EUR = 'eur';

    /**
     * @const string
     */
    const USD = 'usd';

    /**
     * @const string
     */
    const JPY = 'jpy';
}
