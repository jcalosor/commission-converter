<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Entities;

use Commissioner\CommissionTask\Interfaces\PersonsInterface;

class PersonsNatural extends AbstractPersons implements PersonsInterface
{
    /**
     * @const string
     */
    const TYPE = 'natural';
}
