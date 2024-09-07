<?php

namespace Database\Seeders;

use App\Models\OrderType;
use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderType::query()->updateOrInsert(['name' => 'Погрузка/Разгрузка']);
        OrderType::query()->updateOrInsert(['name' => 'Такелажные работы']);
        OrderType::query()->updateOrInsert(['name' => 'Уборка']);
    }
}
