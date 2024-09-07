<?php

namespace App\Http\Resources\User;

use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @mixin Session
 */
class SessionResource extends JsonResource
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
            'user' => UserResource::make($this->user),
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'payload' => $this->payload,
            'last_activity' => Carbon::parse($this->last_activity)->format('d.m.y H:i:s')
        ];
    }
}
