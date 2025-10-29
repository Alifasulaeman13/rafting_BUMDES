<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'code' => ['required','string','max:255','unique:boats,code'],
            'status' => ['required','in:available,in_use,maintenance'],
            'capacity' => ['required','integer','min:1'],
            'notes' => ['nullable','string'],
        ];
    }
}