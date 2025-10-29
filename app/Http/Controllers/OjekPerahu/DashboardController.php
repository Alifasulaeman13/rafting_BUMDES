<?php

namespace App\Http\Controllers\OjekPerahu;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $operator = $user->operator;
        $today = now()->toDateString();
        return response()->json([
            'on_duty' => (bool) optional($operator)->status_aktif,
            'tasks_today' => Order::where('assigned_operator_id', optional($operator)->id)
                ->whereDate('tgl_order', $today)->count(),
        ]);
    }

    public function tasks(Request $request)
    {
        $operatorId = optional($request->user()->operator)->id;
        $tasks = Order::where('assigned_operator_id', $operatorId)
            ->orderBy('tgl_order','desc')->limit(50)->get();
        return response()->json($tasks);
    }
}