<?php

namespace App\Domains\DTO\User;

use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $session_id,
    ) {}
}
