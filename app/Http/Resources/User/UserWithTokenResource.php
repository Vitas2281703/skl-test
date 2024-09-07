<?php

namespace App\Http\Resources\User;

use App\Domains\DTO\User\UserWithTokenData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin UserWithTokenData
 */
class UserWithTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => UserResource::make($this->user),
            'token' => $this->token,
        ];
    }
}
