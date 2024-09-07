<?php

namespace App\Repositories;

use App\Models\Session;
use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserEloquentRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function session(): Session
    {
        return new Session();
    }

    public function getByEmail(string $email): User
    {
        /** @var User */
        return $this->model->newQuery()
            ->where('email', $email)
            ->firstOrFail();
    }

    public function getSessions(int $user_id, int $per_page = 10)
    {
        return $this->session()->newQuery()
            ->where('user_id', $user_id)
            ->paginate($per_page);
    }
}
