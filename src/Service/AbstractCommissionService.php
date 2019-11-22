<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Interfaces\MathInterface;

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
     * The service that will handle mathematical procedure.
     *
     * @var \Commissioner\CommissionTask\Interfaces\MathInterface
     */
    protected $mathService;

    /**
     * AbstractCommissionService constructor.
     *
     * @param \Commissioner\CommissionTask\Interfaces\MathInterface $math
     * @param string $limit
     * @param string $rate
     */
    public function __construct(MathInterface $math, string $limit, string $rate)
    {
        $this->limit = $limit;
        $this->mathService = $math;
        $this->rate = (string)($rate / 100);
    }
}