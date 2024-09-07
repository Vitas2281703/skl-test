<?php

namespace App\Http\Controllers;

use App\Domains\DTO\User\LoginData;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserWithTokenResource;
use App\Services\AuthService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

    public function logout(): Response
    {
        $this->service->logout();

        return response(status: 204);
    }

    public function me(): UserResource
    {
        return UserResource::make(Auth::user());
    }
}
