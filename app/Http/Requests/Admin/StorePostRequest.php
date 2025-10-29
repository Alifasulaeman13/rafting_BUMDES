<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'judul' => ['required','string'],
            'isi' => ['required','string'],
            'gambar' => ['nullable','string'],
            'publish_status' => ['required','in:draft,published'],
            'order_index' => ['nullable','integer'],
        ];
    }
}