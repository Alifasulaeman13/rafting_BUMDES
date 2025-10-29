<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'user_id' => ['nullable','exists:users,id'],
            'nama' => ['sometimes','string'],
            'telepon' => ['nullable','string'],
            'status_aktif' => ['nullable','boolean'],
            'max_tugas_per_hari' => ['nullable','integer','min:1'],
        ];
    }
}