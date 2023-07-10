<?php

namespace App\Http\Requests\Bombas;

use Illuminate\Foundation\Http\FormRequest;

class storeRefillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'factura' => 'nullable|string',
            'quantidade'=>'required|integer|min:1',
        ];
    }
}
