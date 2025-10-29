<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Operator;
use App\Models\Order;
use App\Models\ScheduleRotation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RotationTest extends TestCase
{
    use RefreshDatabase;

    public function test_round_robin_assigns_next_operator()
    {
        Operator::factory()->create(['nama' => 'Op1']);
        Operator::factory()->create(['nama' => 'Op2']);
        Operator::factory()->create(['nama' => 'Op3']);
        ScheduleRotation::create(['pointer_index' => 0]);

        $order = Order::factory()->create(['status' => 'Pending']);

        $this->actingAsUserWithRole('admin')
            ->postJson('/api/rotation/assign/'.$order->id)
            ->assertStatus(200)
            ->assertJsonPath('operator.nama', 'Op1');

        // Next assignment should pick Op2
        $order2 = Order::factory()->create(['status' => 'Pending']);
        $this->postJson('/api/rotation/assign/'.$order2->id)
            ->assertStatus(200)
            ->assertJsonPath('operator.nama', 'Op2');
    }

    private function actingAsUserWithRole(string $role)
    {
        $user = \App\Models\User::factory()->create(['role' => $role]);
        return $this->actingAs($user);
    }
}