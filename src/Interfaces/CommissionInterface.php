<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Interfaces;

interface CommissionInterface
{
    /**
     * The process of commission encashment.
     *
     * @param string $amount
     *
     * @return string
     */
     public function encash(string $amount): string;
}