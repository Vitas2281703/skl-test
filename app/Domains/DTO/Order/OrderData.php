<?php

namespace App\Domains\DTO\Order;

use Spatie\LaravelData\Data;

class OrderData extends Data
{
    /**
     * @param  int[]  $worker_ids
     */
    public function __construct(
        public readonly int $type_id,
        public readonly int $partnership_id,
        public readonly int $user_id,
        public readonly string $description,
        public readonly string $address,
        public readonly int $status_id,
        public readonly ?array $worker_ids = null,
        public readonly int $amount = 1,
    ) {}
}
