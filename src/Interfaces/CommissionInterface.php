<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Interfaces;

interface CommissionInterface
{
    /**
     * The process of commission encashment.
     *
     * @param \Commissioner\CommissionTask\Interfaces\PersonsInterface $person
     * @param string
     */
    public function encash(PersonsInterface $person, string $amount): string;
}
