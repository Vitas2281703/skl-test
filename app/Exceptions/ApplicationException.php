<?php

namespace App\Exceptions;

use RuntimeException;
use Throwable;

class ApplicationException extends RuntimeException
{
    protected string $errorMessage = 'Server error';

    protected int $statusCode = 500;

    public function __construct(?string $message = null, ?int $code = null, ?Throwable $previous = null)
    {
        parent::__construct(
            $message ?: $this->errorMessage ?: $this->message,
            $code ?: $this->statusCode, $previous
        );
    }
}
