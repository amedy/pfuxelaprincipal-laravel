<?php

namespace App\Http\Requests\Tecnico;

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
            'apelido' => 'required|string',
            'data_de_nascimento' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'genero' => 'required',
            'estado_civil' => 'nullable',
            'documento' => 'required',
            'numero_documento' => 'required|string',
            'contacto' => 'required|string',
            'contacto_alternativo' => 'nullable|string',
            'especialidade' => 'required',
        ];
    }
}
