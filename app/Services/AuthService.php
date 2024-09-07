<?php

namespace App\Services;

use App\Domains\DTO\User\LoginData;
use App\Domains\DTO\User\UserWithTokenData;
use App\Exceptions\User\IncorrectPasswordException;
use App\Models\User;
use App\Repositories\UserEloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;

readonly class AuthService
{
    public function __construct(
        protected UserEloquentRepository $repository
    ) {}

    /**
     * @throws IncorrectPasswordException
     */
    public function login(LoginData $data): UserWithTokenData
    {
        $user = $this->repository->getByEmail($data->email);

        if (! Hash::check($data->password, $user->password)) {
            throw new IncorrectPasswordException;
        }

        return UserWithTokenData::from([
            'user' => $user,
            'token' => $user->createToken(config('app.name'))->accessToken,
        ]);
    }

    public function logout(): void
    {
        Auth::user()->tokens()->update(['revoked' => true]);
    }
}
