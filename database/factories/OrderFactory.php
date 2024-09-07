<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => OrderType::query()->newQuery()
                ->inRandomOrder()
                ->first()
                ->id,
            'partnership_id' => Partnership::query()->newQuery()
                ->inRandomOrder()
                ->first()
                ->id,
            'user_id' => User::query()->newQuery()
                ->inRandomOrder()
                ->first()
                ->id,
            'description' => $this->faker->text(500),
            'address' => $this->faker->address,
            'amount' => mt_rand(1, 100),
            'status_id' => OrderStatus::query()->newQuery()
                ->where('name', 'Создан')
                ->first()
                ->id,
        ];
    }
}
