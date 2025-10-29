<?php

namespace Database\Factories;

use App\Models\Boat;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Boat> */
class BoatFactory extends Factory
{
    protected $model = Boat::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'code' => strtoupper(fake()->bothify('BT-##??')),
            'status' => fake()->randomElement(['available','in_use','maintenance']),
            'capacity' => fake()->numberBetween(4, 8),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}