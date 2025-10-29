<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Package> */
class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'name' => 'Paket '.fake()->word().' '.fake()->randomElement(['A','B','C']),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 50000, 250000),
            'min_persons' => fake()->numberBetween(1, 5),
            'max_persons' => fake()->numberBetween(6, 10),
            'includes' => ['helm', 'lifejacket', 'instruktur'],
            'requirements' => ['sehat', 'tidak takut air'],
            'is_active' => true,
        ];
    }
}