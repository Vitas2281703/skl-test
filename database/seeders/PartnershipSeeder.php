<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Database\Seeder;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partnership::factory(5)->create();
    }
}
