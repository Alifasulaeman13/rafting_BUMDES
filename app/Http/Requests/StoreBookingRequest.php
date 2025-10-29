<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && in_array($this->user()->role, ['user','admin']);
    }

    public function rules(): array
    {
        return [
            'package_id' => ['required','exists:packages,id'],
            'tgl_booking' => ['required','date'],
            'jumlah_orang' => ['required','integer','min:1'],
            'metode_pembayaran' => ['required','in:qris,lokasi'],
            'lat' => ['nullable','numeric'],
            'lng' => ['nullable','numeric'],
        ];
    }
}