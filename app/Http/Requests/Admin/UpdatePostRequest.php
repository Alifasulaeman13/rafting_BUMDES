<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'judul' => ['sometimes','string'],
            'isi' => ['sometimes','string'],
            'gambar' => ['nullable','string'],
            'publish_status' => ['sometimes','in:draft,published'],
            'order_index' => ['nullable','integer'],
        ];
    }
}