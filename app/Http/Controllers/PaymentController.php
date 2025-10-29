<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createIntent(Request $request, Booking $booking)
    {
        if ($booking->metode_pembayaran !== 'qris') {
            return response()->json(['message' => 'Metode pembayaran bukan QRIS'], 422);
        }
        // Simpan status pending dan mock payload QR
        $booking->update(['status_pembayaran' => 'Pending']);
        return response()->json([
            'qr_string' => 'QRIS:'.$booking->invoice_code,
            'amount' => $booking->total,
        ]);
    }

    public function webhook(Request $request)
    {
        $data = $request->validate([
            'invoice_code' => ['required','string'],
            'status' => ['required','in:Sukses,Failed'],
        ]);
        $booking = Booking::where('invoice_code', $data['invoice_code'])->firstOrFail();
        $booking->update(['status_pembayaran' => $data['status']]);
        AuditLog::create([
            'action' => 'payment_webhook',
            'meta' => ['invoice_code' => $data['invoice_code'], 'status' => $data['status']],
        ]);
        return response()->json(['updated' => true, 'booking' => $booking]);
    }

    public function status(Booking $booking)
    {
        return response()->json(['status' => $booking->status_pembayaran]);
    }
}