<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Interfaces\CurrencyConverterInterface;
use Commissioner\CommissionTask\Interfaces\MathServiceInterface;

final class CurrencyConverter implements CurrencyConverterInterface
{
    /**
     * The service that will handle mathematical procedure.
     *
     * @var \Commissioner\CommissionTask\Interfaces\MathServiceInterface
     */
    private $mathService;

    /**
     * Configuration of the currency rates conversion.
     *
     * @var mixed[]
     */
    protected $currencyMap;

    /**
     * CurrencyConverter constructor.
     *
     * @param mixed[] $currencyMap
     */
    public function __construct(MathServiceInterface $mathService, array $currencyMap)
    {
        $this->currencyMap = $currencyMap;
        $this->mathService = $mathService;
    }

    /**
     * Return the computed value based on it's difference between currencies.
     */
    public function convert(string $currency, string $value): string
    {
        /** @var string|null $mappedCurrency */
        $mappedCurrency = $this->currencyMap[\strtolower($currency)] ?? null;

        if ($mappedCurrency === null) {
            return $value;
        }

        return $this->mathService->multiply($value, $mappedCurrency);
    }
}
