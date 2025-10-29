<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'min_persons' => ['required', 'integer', 'min:1'],
            'max_persons' => ['nullable', 'integer', 'min:1', 'gte:min_persons'],
            'includes' => ['required', 'string'],
            'requirements' => ['required', 'string'],
            'is_active' => ['boolean'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];
    }
}