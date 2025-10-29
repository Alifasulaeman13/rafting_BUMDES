<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Order> */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'booking_id' => null,
            'jenis_order' => fake()->randomElement(['transfer','antar','orang']),
            'assigned_operator_id' => null,
            'tgl_order' => now()->toDateTimeString(),
            'status' => fake()->randomElement(['Pending','Assigned','Selesai']),
            'meta' => null,
        ];
    }
}