<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Session;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class WorkerEloquentRepository extends BaseRepository
{
    public function model(): string
    {
        return Worker::class;
    }

    public function checkExOrderTypes(array $worker_ids, int $type_id): bool
    {
        return $this->model->newQuery()
            ->whereIn('id', $worker_ids)
            ->whereHas('exOrderTypes', function ($query) use ($type_id) {
                return $query->where('id', $type_id);
            })->exists();
    }
}
