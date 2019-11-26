<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Interfaces;

use Illuminate\Support\Collection;

interface CSVToEntityMapperInterface
{
    /**
     * Set the csv values to be mapped to the persons interface.
     *
     * @param mixed[] $argument
     *
     * @return void
     */
    public function map(array $argument);

    /**
     * Return the resolved (mapped) interface.
     *
     * @return \Illuminate\Support\Collection|\Commissioner\CommissionTask\Interfaces\PersonsInterface[]
     */
    public function getPersons(): Collection;
}
