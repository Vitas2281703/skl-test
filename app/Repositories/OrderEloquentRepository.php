<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class OrderEloquentRepository extends BaseRepository
{
    public function model(): string
    {
        return Order::class;
    }

    /**
     * @param  int[]|null  $worker_ids
     */
    public function save(Order $order, ?array $worker_ids = null): Order
    {
        return DB::transaction(function () use ($order, $worker_ids) {
            $order->save();

            if ($worker_ids !== null) {
                $order->workers()->sync($worker_ids);
            }

            return $order->refresh();
        });
    }
}
