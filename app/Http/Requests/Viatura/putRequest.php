<?php

namespace App\Http\Requests\Viatura;

use Illuminate\Foundation\Http\FormRequest;

class putRequest extends FormRequest
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
            'matricula'=> "required|string",
            'livrete'=> "required",
            'chassi'=> "required",
            'motor'=> "required",
            'descricao'=> "required|string|max:250",
            'combustivel'=>'required',
            'consumo_medio'=> "required|numeric|min:0.1|max:1",
            'capacidade_do_tanque'=>'required|integer|min:1',
    ];
    }
}
