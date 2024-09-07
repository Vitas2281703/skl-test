<?php

namespace App\Exceptions\User;

use App\Exceptions\ApplicationException;

class CannotDeleteSomeoneSessionException extends ApplicationException
{
    protected int $statusCode = 403;

    protected string $errorMessage = 'Невозможно удалить чей-то сеанс';
}
