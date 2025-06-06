<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['sometimes', 'required', 'string'],
            'price' => ['sometimes', 'required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }
}
