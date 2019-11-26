<?php

declare(strict_types=1);

namespace Commissioner\CommissionTask\Exceptions;

use Symfony\Component\Config\Definition\Exception\Exception;

class UnsupportedFileFormatException extends Exception
{
    /**
     * UnsupportedFileFormatException constructor.
     */
    public function __construct(
        string $message = null,
        int $code = 0,
        \Throwable $previous = null,
        string $format = null
    ) {
        if (null === $message) {
            if (null === $format) {
                $message = 'File format is not supported.';
            } else {
                $message = sprintf('File format "%s" is not supported.', $format);
            }
        }

        parent::__construct($message, $code, $previous);
    }
}
