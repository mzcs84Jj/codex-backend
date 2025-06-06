<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['sometimes', 'required', 'date'],
            'customer_id' => ['sometimes', 'required', 'exists:customers,id'],
            'products' => ['sometimes', 'required', 'array', 'min:1'],
            'products.*.product_id' => ['required_with:products', 'exists:products,id'],
            'products.*.quantity' => ['required_with:products', 'integer', 'min:1'],
            'products.*.price' => ['required_with:products', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }
}
