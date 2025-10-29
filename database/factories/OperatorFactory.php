<?php

namespace Database\Factories;

use App\Models\Operator;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Operator> */
class OperatorFactory extends Factory
{
    protected $model = Operator::class;

    public function definition(): array
    {
        return [
            'user_id' => null,
            'nama' => fake()->name(),
            'telepon' => fake()->phoneNumber(),
            'status_aktif' => true,
            'max_tugas_per_hari' => 10,
        ];
    }
}