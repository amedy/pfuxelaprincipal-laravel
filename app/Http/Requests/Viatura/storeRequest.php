<?php

namespace App\Http\Requests\Viatura;

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
                'marca' =>'required',
                'tipo'=>'required',
                'modelo'=>'required|string',
                'ano_de_fabrico'=> "required|numeric|min:1960|max:" . date('Y'),
                'lotacao'=> 'required|integer|min:1',
                'matricula'=> "required|string|unique:viatura",
                'livrete'=> "required",
                'chassi'=> "required",
                'motor'=> "required",
                'descricao'=> "required|string|max:250",
                'combustivel'=>'required',
                'consumo_medio'=> "required|numeric|min:0.1|max:1",
                'capacidade_do_tanque'=>'required|integer|min:1',
                'kilometragem'=>'required|numeric|min:0',
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
