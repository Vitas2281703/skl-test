<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\SelectResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Worker\WorkerResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => SelectResource::make($this->type),
            'partnership' => SelectResource::make($this->partnership),
            'user' => UserResource::make($this->user),
            'description' => $this->description,
            'address' => $this->address,
            'amount' => $this->amount,
            'status' => SelectResource::make($this->status),
            'workers' => WorkerResource::collection($this->workers),
        ];
    }
}
