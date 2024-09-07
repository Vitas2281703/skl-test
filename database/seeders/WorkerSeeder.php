<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use App\Models\OrderType;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workers = Worker::factory(5)->create();
        $orderTypes = OrderType::all();

        foreach ($workers as $worker) {
            /** @var Worker $worker */
            $worker->exOrderTypes()->sync([$orderTypes->random()->id]);
        }
    }
}
