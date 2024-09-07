<?php

namespace App\Http\Controllers;

use App\Domains\DTO\Order\OrderData;
use App\Domains\DTO\User\LoginData;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Order\ChangeStatusRequest;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\SyncWorkersRequest;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\User\SessionResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserWithTokenResource;
use App\Services\AuthService;
use App\Services\OrderService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    public function __construct(
        protected readonly OrderService $service
    ) {}

    public function create(CreateRequest $request): OrderResource
    {
        return OrderResource::make(
            $this->service->create(
                OrderData::from(
                    $request->toArray(),
                    ['user_id' => Auth::id()]
                )
            )
        );
    }

    public function syncWorkers(SyncWorkersRequest $request, int $order_id): OrderResource
    {
        return OrderResource::make(
            $this->service->syncWorkers($order_id, $request->input('worker_ids'))
        );
    }

    public function changeStatus(ChangeStatusRequest $request, int $order_id): OrderResource
    {
        return OrderResource::make(
            $this->service->chageStatus($order_id, $request->input('status_id'))
        );
    }


}
