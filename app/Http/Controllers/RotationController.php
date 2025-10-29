<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Operator;
use App\Models\ScheduleRotation;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class RotationController extends Controller
{
    public function assign(Request $request, Order $order)
    {
        if ($order->status !== 'Pending') {
            return response()->json(['message' => 'Order not pending'], 422);
        }

        $operators = Operator::where('status_aktif', true)->orderBy('id')->get();
        if ($operators->isEmpty()) return response()->json(['message' => 'No active operators'], 422);

        $rotation = ScheduleRotation::first();
        if (!$rotation) {
            $rotation = ScheduleRotation::create(['pointer_index' => 0]);
        }

        $count = $operators->count();
        $start = $rotation->pointer_index % $count;

        $selected = null;
        for ($i = 0; $i < $count; $i++) {
            $idx = ($start + $i) % $count;
            $candidate = $operators[$idx];
            // Cek batas tugas per hari
            $today = now()->toDateString();
            $tasksToday = $candidate->orders()->whereDate('tgl_order', $today)->count();
            if ($tasksToday < $candidate->max_tugas_per_hari) {
                $selected = $candidate; break;
            }
        }

        if (!$selected) {
            return response()->json(['message' => 'All operators at capacity'], 422);
        }

        $order->update([
            'assigned_operator_id' => $selected->id,
            'status' => 'Assigned',
        ]);

        $rotation->update([
            'pointer_index' => ($selected->id === $operators[$count-1]->id)
                ? 0
                : ($operators->search($selected) + 1),
            'last_assigned_operator_id' => $selected->id,
        ]);

        AuditLog::create([
            'action' => 'rotation_assign',
            'order_id' => $order->id,
            'meta' => ['operator_id' => $selected->id],
        ]);

        return response()->json($order->load('operator'));
    }
}