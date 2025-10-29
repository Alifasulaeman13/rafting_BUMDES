<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ConfigController extends Controller
{
    public function payment(Request $request)
    {
        $data = $request->validate([
            'qris_enabled' => ['required','boolean'],
            'pay_on_site_enabled' => ['required','boolean'],
        ]);
        // Simpan ke .env atau ke database konfigurasi; untuk demo gunakan config runtime
        Config::set('services.payment.qris_enabled', $data['qris_enabled']);
        Config::set('services.payment.pay_on_site_enabled', $data['pay_on_site_enabled']);
        return response()->json(['saved' => true, 'config' => $data]);
    }
}