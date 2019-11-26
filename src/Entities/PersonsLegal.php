<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Entities;

use Commissioner\CommissionTask\Interfaces\PersonsInterface;

class PersonsLegal extends AbstractPersons implements PersonsInterface
{
    /**
     * @const string
     */
    const TYPE = 'legal';
}
