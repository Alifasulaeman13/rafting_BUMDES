<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function bookings(Request $request)
    {
        $q = Booking::query()->with('package');
        if ($request->filled('from')) $q->whereDate('tgl_booking', '>=', $request->get('from'));
        if ($request->filled('to')) $q->whereDate('tgl_booking', '<=', $request->get('to'));
        if ($request->filled('package_id')) $q->where('package_id', $request->get('package_id'));
        return response()->json($q->orderBy('tgl_booking','desc')->paginate(20));
    }

    public function orders(Request $request)
    {
        $q = Order::query()->with(['operator','booking']);
        if ($request->filled('from')) $q->whereDate('tgl_order', '>=', $request->get('from'));
        if ($request->filled('to')) $q->whereDate('tgl_order', '<=', $request->get('to'));
        if ($request->filled('assigned_operator_id')) $q->where('assigned_operator_id', $request->get('assigned_operator_id'));
        return response()->json($q->orderBy('tgl_order','desc')->paginate(20));
    }
}