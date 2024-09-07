<?php

namespace App\Exceptions\User;

use App\Exceptions\ApplicationException;

class IncorrectPasswordException extends ApplicationException
{
    protected int $statusCode = 422;

    protected string $errorMessage = 'Неверный пароль';
}
