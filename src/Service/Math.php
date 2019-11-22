<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Service;

use Commissioner\CommissionTask\Interfaces\MathInterface;

class Math implements MathInterface
{
    private $scale;

    public function __construct(int $scale)
    {
        $this->scale = $scale;
    }

    /**
     * Addition method using bcmath.
     *
     * @param string $leftOperand
     * @param string $rightOperand
     *
     * @return string
     */
    public function add(string $leftOperand, string $rightOperand): string
    {
        return \bcadd($leftOperand, $rightOperand, $this->scale);
    }

    /**
     * Multiplication method using bcmath.
     *
     * @param string $leftOperand
     * @param string $rightOperand
     *
     * @return string
     */
    public function multiply(string $leftOperand, string $rightOperand): string
    {
        return \bcmul($leftOperand, $rightOperand, $this->scale);
    }
}
