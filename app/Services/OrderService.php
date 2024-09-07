<?php

namespace App\Services;

use App\Domains\DTO\Order\OrderData;
use App\Domains\DTO\User\LoginData;
use App\Domains\DTO\User\UserWithTokenData;
use App\Exceptions\Order\IncorrectWorkersException;
use App\Exceptions\User\CannotDeleteSomeoneSessionException;
use App\Exceptions\User\IncorrectPasswordException;
use App\Models\Order;
use App\Models\Session;
use App\Repositories\OrderEloquentRepository;
use App\Repositories\SessionEloquentRepository;
use App\Repositories\UserEloquentRepository;
use App\Repositories\WorkerEloquentRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

readonly class OrderService
{
    public function __construct(
        protected readonly OrderEloquentRepository $repository,
        protected readonly WorkerEloquentRepository $workerRepository
    ) {}

    public function create(OrderData $data): Order
    {
        return $this->save(
            new Order($data->toArray()),
            $data->worker_ids
        );
    }

    public function syncWorkers(int $order_id, array $worker_ids = []): Order
    {
        return $this->save(
            $this->repository->find($order_id),
            $worker_ids
        );
    }

    public function chageStatus(int $order_id, int $status_id): Order
    {
        /** @var Order $order */
        $order = $this->repository->find($order_id);
        $order->status_id = $status_id;

        return $this->save(
            $order
        );
    }

    public function save(Order $order, ?array $worker_ids = null): Order
    {
        if (!empty($worker_ids)) {
            if ($this->workerRepository->checkExOrderTypes($worker_ids, $order->type_id)) {
                throw new IncorrectWorkersException();
            }
        }

        return $this->repository->save(
            $order,
            $worker_ids
        );
    }

}
