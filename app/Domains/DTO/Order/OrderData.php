<?php

namespace App\Domains\DTO\Order;

use Spatie\LaravelData\Data;

class OrderData extends Data
{
    /**
     * @param int $type_id
     * @param int $partnership_id
     * @param int $user_id
     * @param string $description
     * @param string $address
     * @param int $status_id
     * @param int[] $worker_ids
     * @param int $amount
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
