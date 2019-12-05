<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Interfaces;

interface PersonsInterface
{
    public function getOperationDate(): string;

    public function getIdentification(): string;

    public function getPersonType(): string;

    public function getOperationType(): string;

    public function getOperationAmount(): string;

    public function getOperationCurrency(): string;
}
