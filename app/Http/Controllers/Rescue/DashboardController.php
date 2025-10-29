<?php

namespace App\Http\Controllers\Rescue;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->toDateString();
        $emergencyCount = Notification::where('target_role','rescue')
            ->whereDate('created_at',$today)->count();
        return response()->json([
            'emergency_notifications_today' => $emergencyCount,
        ]);
    }

    public function confirmReady(Request $request)
    {
        $member = $request->user()->rescueMember;
        if (!$member) return response()->json(['message' => 'Not a rescue member'], 422);
        $member->update(['status_oncall' => true]);
        AuditLog::create([
            'action' => 'rescue_confirm_ready',
            'user_id' => $request->user()->id,
            'meta' => ['rescue_member_id' => $member->id],
        ]);
        return response()->json(['oncall' => true]);
    }

    public function markComplete(Request $request, Order $order)
    {
        $order->update(['status' => 'Selesai']);
        AuditLog::create([
            'action' => 'order_mark_complete',
            'user_id' => $request->user()->id,
            'order_id' => $order->id,
            'meta' => ['from_status' => 'Assigned', 'to_status' => 'Selesai'],
        ]);
        return response()->json($order);
    }
}