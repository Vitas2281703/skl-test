<?php

namespace App\Repositories;

use App\Models\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

class SessionEloquentRepository extends BaseRepository
{
    public function model(): string
    {
        return Session::class;
    }

    public function getSessions(int $user_id, int $per_page = 10): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->where('user_id', $user_id)
            ->paginate($per_page);
    }
}
