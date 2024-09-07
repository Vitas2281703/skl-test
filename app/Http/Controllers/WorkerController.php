<?php

namespace App\Http\Controllers;

use App\Domains\DTO\Worker\FilterData;
use App\Http\Requests\Worker\FilterRequest;
use App\Http\Resources\Worker\WorkerResource;
use App\Services\WorkerService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkerController
{
    public function __construct(
        protected readonly WorkerService $service
    ) {}

    public function list(FilterRequest $request): AnonymousResourceCollection
    {
        return WorkerResource::collection(
            $this->service->list(
                FilterData::from($request->toArray())
            )
        );
    }
}
