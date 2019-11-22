<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Interfaces\CashOutInterface;

class CashOut extends AbstractCommissionService implements CashOutInterface
{

    /**
     * The process of commission encashment.
     *
     * @param string $amount
     *
     * @return string
     */
    public function encash(string $amount): string
    {
        $result = $this->mathService->multiply($this->rate, $amount);

        if (\bccomp($this->limit, $result) > 0) {
            return $this->limit;
        }

        return $result;
    }
}