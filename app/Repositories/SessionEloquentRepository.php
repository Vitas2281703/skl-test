<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

class SessionEloquentRepository extends BaseRepository
{
    public function model(): string
    {
        return Sess::class;
    }

    public function getByEmail(string $email): User
    {
        /** @var User */
        return $this->model->newQuery()
            ->where('email', $email)
            ->firstOrFail();
    }
}
