<?php

namespace App\Services;

use App\Domains\DTO\Order\OrderData;
use App\Exceptions\Order\IncorrectWorkersException;
use App\Models\Order;
use App\Repositories\OrderEloquentRepository;
use App\Repositories\WorkerEloquentRepository;

readonly class OrderService
{
    public function __construct(
        protected OrderEloquentRepository $repository,
        protected WorkerEloquentRepository $workerRepository
    ) {}

    public function create(OrderData $data): Order
    {
        return $this->save(
            new Order($data->toArray()),
            $data->worker_ids
        );
    }

    /**
     * @param  int[]  $worker_ids
     */
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

    /**
     * @param  int[]|null  $worker_ids
     */
    public function save(Order $order, ?array $worker_ids = null): Order
    {
        if (! empty($worker_ids)) {
            if ($this->workerRepository->checkExOrderTypes($worker_ids, $order->type_id)) {
                throw new IncorrectWorkersException;
            }
        }

        return $this->repository->save(
            $order,
            $worker_ids
        );
    }
}
