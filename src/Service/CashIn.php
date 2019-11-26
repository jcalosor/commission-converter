<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Interfaces\CashInInterface;
use Commissioner\CommissionTask\Interfaces\PersonsInterface;

class CashIn extends AbstractCommissionService implements CashInInterface
{
    /**
     * The process of commission encashment.
     */
    public function encash(PersonsInterface $person, string $amount): string
    {
        $result = $this->mathService->multiply($this->rate, $amount);

        if (\bccomp($result, $this->limit, $this->scale) > 0) {
            return $this->roundOf($this->limit);
        }

        return $this->roundOf($result);
    }
}
