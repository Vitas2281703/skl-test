<?php

namespace App\Http\Resources;

use App\Models\OrderStatus;
use App\Models\OrderType;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Partnership|OrderType|OrderStatus
 */
class SelectResource extends JsonResource
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
            'name' => $this->name,
        ];
    }
}
