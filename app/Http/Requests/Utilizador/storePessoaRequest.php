<?php

namespace App\Http\Requests\Utilizador;

use Illuminate\Foundation\Http\FormRequest;

class storePessoaRequest extends FormRequest
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
            'nome' => 'required|string|',
            'apelido' => 'required|string',
            'data_de_nascimento' => 'required|date|before:' . now()->format('d-m-Y'),
            'genero' => 'required',
            'estado_civil' => 'nullable',
            'documento' => 'required',
            'numero_documento' => 'required|string',
            'contacto' => 'required|string',
            'contacto_alternativo' => 'nullable|string',
            'inss' => 'nullable|numeric',
            'nuit' => 'nullable|numeric',
            'morada' => 'nullable|string|max:256',
        ];
    }
}
