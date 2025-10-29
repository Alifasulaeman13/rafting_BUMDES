<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Booking> */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'package_id' => 1,
            'tgl_booking' => now()->addDays(fake()->numberBetween(1, 10))->toDateString(),
            'jumlah_orang' => fake()->numberBetween(2, 6),
            'total' => fake()->randomFloat(2, 100000, 1000000),
            'metode_pembayaran' => fake()->randomElement(['qris','lokasi']),
            'status_pembayaran' => fake()->randomElement(['Pending','Sukses','Failed','Cancel']),
            'invoice_code' => (string) \Illuminate\Support\Str::uuid(),
            'lat' => -7.8000000,
            'lng' => 110.3600000,
            'meta' => null,
        ];
    }
}