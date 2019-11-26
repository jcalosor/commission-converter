<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Interfaces;

interface MathServiceInterface
{
    /**
     * Addition method using bcmath.
     */
    public function add(string $leftOperand, string $rightOperand): string;

    /**
     * Multiplication method using bcmath.
     */
    public function multiply(string $leftOperand, string $rightOperand): string;
}
