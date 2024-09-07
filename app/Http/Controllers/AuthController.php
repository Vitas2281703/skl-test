<?php

namespace App\Http\Controllers;

use App\Domains\DTO\User\LoginData;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\User\UserWithTokenResource;
use App\Services\AuthService;

class AuthController
{
    public function __construct(
        protected readonly AuthService $service
    ) {}

    public function login(LoginRequest $request): UserWithTokenResource
    {
        return UserWithTokenResource::make(
            $this->service->login(
                LoginData::from($request->toArray())
            )
        );
    }
}
