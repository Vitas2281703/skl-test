<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::query()->updateOrInsert(['name' => 'Создан']);
        OrderStatus::query()->updateOrInsert(['name' => 'Назначен исполнитель']);
        OrderStatus::query()->updateOrInsert(['name' => 'Завершен']);
    }
}
