<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $order = Order::create([
            'booking_id' => $data['booking_id'] ?? null,
            'jenis_order' => $data['jenis_order'],
            'tgl_order' => $data['tgl_order'],
            'status' => 'Pending',
            'meta' => $data['meta'] ?? null,
        ]);
        return response()->json($order, 201);
    }
}