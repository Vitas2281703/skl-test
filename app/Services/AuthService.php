<?php

namespace App\Services;

use App\Domains\DTO\User\LoginData;
use App\Domains\DTO\User\UserWithTokenData;
use App\Exceptions\User\CannotDeleteSomeoneSessionException;
use App\Exceptions\User\IncorrectPasswordException;
use App\Models\Session;
use App\Models\User;
use App\Repositories\SessionEloquentRepository;
use App\Repositories\UserEloquentRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;

readonly class AuthService
{
    public function __construct(
        protected UserEloquentRepository $repository,
        protected SessionEloquentRepository $sessionRepository
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

        $token = $user->createToken(config('app.name'));
        $token->token->update(['session_id' => $data->session_id]);

        return UserWithTokenData::from([
            'user' => $user,
            'token' => $token->accessToken,
        ]);
    }

    public function logout(): void
    {
        Auth::user()->token()->update(['revoked' => true]);
    }

    public function getSessions(int $user_id, int $per_page = 10): LengthAwarePaginator
    {
        return $this->sessionRepository->getSessions($user_id, $per_page);
    }

    public function closeSession(int $user_id, string $session_id): void
    {
        /** @var Session $session */
        $session = $this->sessionRepository->find($session_id);

        if ($session->user_id != $user_id) {
            throw new CannotDeleteSomeoneSessionException();
        }

        $session->delete();
    }
}
