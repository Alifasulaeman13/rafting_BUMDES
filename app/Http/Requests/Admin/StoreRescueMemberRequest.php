<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRescueMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'user_id' => ['nullable','exists:users,id'],
            'nama' => ['required','string'],
            'telepon' => ['nullable','string'],
            'status_oncall' => ['nullable','boolean'],
        ];
    }
}