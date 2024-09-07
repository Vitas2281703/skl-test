<?php

namespace App\Exceptions\Order;

use App\Exceptions\ApplicationException;

class IncorrectWorkersException extends ApplicationException
{
    protected int $statusCode = 422;

    protected string $errorMessage = 'Исполнители отказались выполнять заказы с выбранным типом';
}
