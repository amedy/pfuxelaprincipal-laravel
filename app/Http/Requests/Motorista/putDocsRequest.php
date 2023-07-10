<?php

namespace App\Http\Requests\Motorista;

use Illuminate\Foundation\Http\FormRequest;

class putDocsRequest extends FormRequest
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
            'data_emissao' => 'required|date|before_or_equal:' . date('d-m-Y'),
            'data_validade' => 'required|date|after:' . date('d-m-Y'),
        ];
    }
}
