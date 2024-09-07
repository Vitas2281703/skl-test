<?php

namespace App\Services;

use App\Domains\DTO\User\LoginData;
use App\Domains\DTO\User\UserWithTokenData;
use App\Exceptions\User\IncorrectPasswordException;
use App\Models\User;
use App\Repositories\UserEloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\Token;

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
