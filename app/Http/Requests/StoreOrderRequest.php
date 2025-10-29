<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null; // any authenticated role can create order
    }

    public function rules(): array
    {
        return [
            'booking_id' => ['nullable','exists:bookings,id'],
            'jenis_order' => ['required','in:transfer,antar,orang'],
            'tgl_order' => ['required','date'],
            'meta' => ['nullable','array'],
        ];
    }
}