<?php

namespace Database\Factories;

use App\Models\RescueMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<RescueMember> */
class RescueMemberFactory extends Factory
{
    protected $model = RescueMember::class;

    public function definition(): array
    {
        return [
            'user_id' => null,
            'nama' => 'Rescue '.fake()->firstName(),
            'telepon' => fake()->phoneNumber(),
            'status_oncall' => false,
        ];
    }
}