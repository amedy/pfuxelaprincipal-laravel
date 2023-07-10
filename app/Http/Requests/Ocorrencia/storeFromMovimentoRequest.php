<?php

namespace App\Http\Requests\Ocorrencia;

use Illuminate\Foundation\Http\FormRequest;

class storeFromMovimentoRequest extends FormRequest
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
            'descricao_motorista'=> "required|string",
            'descricao_inspeccao'=> "required|string",
            'tipo'=> "required|string",
            'data_hora_ocorrencia'=> "required|date|after:" . date('d-m-Y, 23:59', strtotime('-1 day')) ."|before_or_equal:" . date('d-m-Y H:i'),
        ];
    }
}
