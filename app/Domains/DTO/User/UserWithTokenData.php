<?php

namespace App\Domains\DTO\User;

use App\Models\User;
use Spatie\LaravelData\Data;

class UserWithTokenData extends Data
{
    public function __construct(
        public readonly User $user,
        public readonly string $token
    ) {}
}
