<?php

namespace App\Services;

use App\Domains\DTO\User\UserWithTokenData;
use App\Repositories\UserEloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

readonly class SessionService
{
    public function __construct(
        protected UserEloquentRepository $repository
    ) {}

    public function login(): UserWithTokenData
    {
        Session::all();

        return UserWithTokenData::from([
        ]);
    }

    public function logout(): void
    {
        Auth::user()->tokens()->update(['revoked' => true]);
    }
}
