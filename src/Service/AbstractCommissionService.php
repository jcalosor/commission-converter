<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Interfaces\MathServiceInterface;

abstract class AbstractCommissionService
{
    /**
     * Limit threshold of commission.
     *
     * @var string
     */
    protected $limit;

    /**
     * Percentage rate of commission in %.
     *
     * @var string
     */
    protected $rate;

    /**
     * The number count after decimal points.
     *
     * @var int
     */
    protected $scale;

    /**
     * The service that will handle mathematical procedure.
     *
     * @var \Commissioner\CommissionTask\Interfaces\MathServiceInterface
     */
    protected $mathService;

    /**
     * AbstractCommissionService constructor.
     */
    public function __construct(MathServiceInterface $mathService, string $limit, string $rate, int $scale)
    {
        $this->limit = $limit;
        $this->mathService = $mathService;
        $this->rate = (string) (\floatval($rate) / 100);
        $this->scale = $scale;
    }

    protected function roundOf(string $value): string
    {
        $number = (float) \round((float) $value, $this->scale);

        return \number_format($number, $this->scale, '.', '');
    }
}
