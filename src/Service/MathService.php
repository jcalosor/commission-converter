<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Interfaces\MathServiceInterface;

class MathService implements MathServiceInterface
{
    /**
     * The number count after decimal points.
     *
     * @var int
     */
    private $scale;

    public function __construct(int $scale)
    {
        $this->scale = $scale;
    }

    /**
     * Addition method using bcmath.
     */
    public function add(string $leftOperand, string $rightOperand): string
    {
        return \bcadd($leftOperand, $rightOperand, $this->scale);
    }

    /**
     * Multiplication method using bcmath.
     */
    public function multiply(string $leftOperand, string $rightOperand): string
    {
        return \bcmul($leftOperand, $rightOperand, $this->scale);
    }
}
