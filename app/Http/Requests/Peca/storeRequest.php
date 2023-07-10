<?php

namespace App\Http\Requests\Peca;

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
            'designacao' => 'required|string',
            'custo_da_peca' => 'required|numeric|min:1',
            'quantidade_inicial' => 'required|numeric|min:1',
            'quantidade_minima' => 'required|numeric|min:1',
            'descricao'=> "nullable|string|max:250",
        ];
    }
}
