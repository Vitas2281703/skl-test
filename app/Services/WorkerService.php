<?php

namespace App\Services;

use App\Domains\DTO\Worker\FilterData;
use App\Repositories\WorkerEloquentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class WorkerService
{
    public function __construct(
        protected WorkerEloquentRepository $workerRepository
    ) {}

    public function list(FilterData $data): LengthAwarePaginator
    {
        return $this->workerRepository->getList($data);
    }
}
