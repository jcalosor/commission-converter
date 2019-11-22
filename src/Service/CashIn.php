<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Interfaces\CashInInterface;

class CashIn extends AbstractCommissionService implements CashInInterface
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

        if (\bccomp($result, $this->limit) > 0) {
            return $this->limit;
        }

        \var_dump($this->limit, $this->rate);

        return $result;
    }
}