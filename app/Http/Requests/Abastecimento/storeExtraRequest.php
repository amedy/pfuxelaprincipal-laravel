<?php

namespace App\Http\Requests\Abastecimento;

use Illuminate\Foundation\Http\FormRequest;

class storeExtraRequest extends FormRequest
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
            'bombas' => 'required',
            'objectivo' => 'required',
            'destino' => 'nullable|required_unless:objectivo,Rota|',
            'viatura' => 'required',
            'quantidade' => 'required|numeric|min:0.1|max:10',
            'justificacao' => 'required|string',
        ];
    }
}
