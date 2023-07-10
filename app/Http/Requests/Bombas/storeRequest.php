<?php

namespace App\Http\Requests\Bombas;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
            'nome' => 'required|string',
            'tipo'=>'required',
            'capacidade_das_bombas'=>'nullable|integer|min:1',
            'quantidade_minima'=>'nullable|integer|min:1',
            'quantidade_disponivel'=>'nullable|integer|min:0',
        ];
    }
}
