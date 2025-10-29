<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();

        $user = $request->user();
        $package = Package::findOrFail($data['package_id']);

        return DB::transaction(function () use ($data, $package, $user) {
            // Validasi kapasitas: hitung total ter-booking untuk tanggal tersebut
            $booked = Booking::where('package_id', $package->id)
                ->whereDate('tgl_booking', $data['tgl_booking'])
                ->whereIn('status_pembayaran', ['Pending','Sukses'])
                ->sum('jumlah_orang');

            if ($booked + $data['jumlah_orang'] > $package->max_persons) {
                return response()->json(['message' => 'Kapasitas paket tidak mencukupi'], 422);
            }

            $harga = $package->price;
            $total = $harga * $data['jumlah_orang'];

            $booking = Booking::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'tgl_booking' => $data['tgl_booking'],
                'jumlah_orang' => $data['jumlah_orang'],
                'total' => $total,
                'metode_pembayaran' => $data['metode_pembayaran'],
                'status_pembayaran' => 'Pending',
                'invoice_code' => Str::uuid()->toString(),
                'lat' => $data['lat'] ?? null,
                'lng' => $data['lng'] ?? null,
            ]);

            return response()->json($booking, 201);
        });
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return response()->json($booking->load(['package']));
    }
}