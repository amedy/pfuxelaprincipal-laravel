<?php

namespace App\Http\Requests\Viatura;

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
            'inspeccao_data_emissao'=> "required|date|before_or_equal:today",
            'inspeccao_data_validade'=> "required|date",
            'manifesto_data_emissao'=> "required|date|before_or_equal:today",
            'manifesto_data_validade'=> "required|date",
            'seguro_data_emissao'=> "required|date|before_or_equal:today",
            'seguro_data_validade'=> "required|date",
            'taxa_radio_data_emissao'=> "required|date|before_or_equal:today",
            'taxa_radio_data_validade'=> "required|date",
    ];
    }
}
