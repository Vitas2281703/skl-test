<?php

namespace App\Http\Controllers;

use App\Domains\DTO\User\LoginData;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\User\SessionResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserWithTokenResource;
use App\Services\AuthService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController
{
    public function __construct(
        protected readonly AuthService $service
    ) {}

    public function login(LoginRequest $request): UserWithTokenResource
    {
        return UserWithTokenResource::make(
            $this->service->login(
                LoginData::from(
                    $request->toArray(),
                    ['session_id' => $request->session()->getId()]
                )
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

    public function sessions(): AnonymousResourceCollection
    {
        return SessionResource::collection(
            $this->service->getSessions(
                Auth::id(),
                request()->input('per_page') ?? 10
            )
        );
    }

    public function closeSession(string $session_id): Response
    {
        $this->service->closeSession(Auth::id(), $session_id);

        return response(status: 204);
    }
}
