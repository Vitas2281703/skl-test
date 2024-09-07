<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::factory(5)->create();
        $workers = Worker::query()->newQuery()->limit(5)->get();

        foreach ($orders as $order) {
            /** @var Order $order */
            $order->workers()->sync([$workers->random()->id]);
        }
    }
}
