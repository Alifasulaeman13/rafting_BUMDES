<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBoatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        $boatId = $this->route('boat')?->id;
        return [
            'name' => ['sometimes','string','max:255'],
            'code' => ['sometimes','string','max:255','unique:boats,code,'.$boatId],
            'status' => ['sometimes','in:available,in_use,maintenance'],
            'capacity' => ['sometimes','integer','min:1'],
            'notes' => ['nullable','string'],
        ];
    }
}