<?php

namespace App\Http\Requests\Rpiquete;

use Illuminate\Foundation\Http\FormRequest;

class planoRequest extends FormRequest
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
            'motorista' => 'required|string|',
            'cliente'=>'required',
            'local_origem' => 'required',
            'local_destino' =>'required',
            'numero_passageiro' =>'required',
            'data_partida' =>'required',
            'data_chegada' => 'required',
            'file' => 'required',
            'created_at' => now()

        ];
    }
}
