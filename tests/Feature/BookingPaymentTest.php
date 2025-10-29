<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Package;
use App\Models\Booking;

class BookingPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_booking_and_check_payment_status()
    {
        $user = User::factory()->create(['role' => 'user']);
        $package = Package::factory()->create(['kapasitas' => 20, 'harga_per_orang' => 100000]);

        $payload = [
            'package_id' => $package->id,
            'tgl_booking' => now()->addDay()->toDateString(),
            'jumlah_orang' => 3,
            'metode_pembayaran' => 'qris',
        ];

        $res = $this->actingAs($user)->postJson('/api/bookings', $payload)
            ->assertStatus(201)->json();

        $booking = Booking::find($res['id']);
        $this->actingAs($user)->postJson('/api/payment/intent/'.$booking->id)
            ->assertStatus(200)
            ->assertJsonStructure(['qr_string','amount']);

        // Simulate webhook success
        $this->postJson('/api/payment/webhook', [
            'invoice_code' => $booking->invoice_code,
            'status' => 'Sukses',
        ])->assertStatus(200);

        $this->actingAs($user)->getJson('/api/payment/status/'.$booking->id)
            ->assertStatus(200)
            ->assertJsonPath('status', 'Sukses');
    }
}