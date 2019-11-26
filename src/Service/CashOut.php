<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Entities\PersonsLegal;
use Commissioner\CommissionTask\Interfaces\CashOutInterface;
use Commissioner\CommissionTask\Interfaces\PersonsInterface;

class CashOut extends AbstractCommissionService implements CashOutInterface
{
    /**
     * The process of commission encashment.
     */
    public function encash(PersonsInterface $person, string $amount): string
    {
        $result = $this->mathService->multiply($this->rate, $amount);

        if (\bccomp($this->limit, $result, $this->scale) > 0 && $person instanceof PersonsLegal === true) {
            return $this->roundOf($this->limit);
        }

        return $this->roundOf($result);
    }
}
