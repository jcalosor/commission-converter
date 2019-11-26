<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Entities;

abstract class AbstractPersons
{
    /**
     * @var string
     */
    protected $operationDate;

    /**
     * @var string
     */
    protected $identification;

    /**
     * @var string
     */
    protected $personType;

    /**
     * @var string
     */
    protected $operationType;

    /**
     * @var string
     */
    protected $operationAmount;

    /**
     * @var string
     */
    protected $operationCurrency;

    /**
     * AbstractPersons constructor.
     */
    public function __construct(array $attributes = [])
    {
        $this->operationDate = $attributes['operation_date'] ?? '';
        $this->identification = $attributes['identification'] ?? '';
        $this->personType = $attributes['person_type'] ?? '';
        $this->operationType = $attributes['operation_type'] ?? '';
        $this->operationAmount = $attributes['operation_amount'] ?? '';
        $this->operationCurrency = $attributes['operation_currency'] ?? '';
    }

    public function getOperationDate(): string
    {
        return $this->operationDate;
    }

    public function getIdentification(): string
    {
        return $this->identification;
    }

    public function getPersonType(): string
    {
        return $this->personType;
    }

    public function getOperationType(): string
    {
        return $this->operationType;
    }

    public function getOperationAmount(): string
    {
        return $this->operationAmount;
    }

    public function getOperationCurrency(): string
    {
        return $this->operationCurrency;
    }
}
