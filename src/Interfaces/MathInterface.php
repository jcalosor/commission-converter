<?php

namespace Commissioner\CommissionTask\Interfaces;

interface MathInterface
{
    /**
     * Addition method using bcmath.
     *
     * @param string $leftOperand
     * @param string $rightOperand
     *
     * @return string
     */
    public function add(string $leftOperand, string $rightOperand): string;

    /**
     * Multiplication method using bcmath.
     *
     * @param string $leftOperand
     * @param string $rightOperand
     *
     * @return string
     */
    public function multiply(string $leftOperand, string $rightOperand): string;
}