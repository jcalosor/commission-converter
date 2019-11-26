<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Exceptions;

use Symfony\Component\Config\Definition\Exception\Exception;

class EntityValidationException extends Exception
{
    /**
     * Validation errors.
     *
     * @var mixed[]
     */
    private $errors;

    /**
     * Create validation exception.
     *
     * @param mixed[]|null $messageParameters
     * @param mixed[]|null $errors
     */
    public function __construct(
        string $message = null,
        array $messageParameters = null,
        int $code = null,
        \Throwable $previous = null,
        array $errors = null
    ) {
        parent::__construct($message ?? '', $code ?? 0, $previous);

        $this->errors = $errors ?? [];
    }

    /**
     * @return mixed[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getStatusCode(): int
    {
        return 400;
    }
}
