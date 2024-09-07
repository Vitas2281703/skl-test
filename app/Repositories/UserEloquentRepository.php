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
        return new Session;
    }

    public function getByEmail(string $email): User
    {
        /** @var User */
        return $this->model->newQuery()
            ->where('email', $email)
            ->firstOrFail();
    }
}
