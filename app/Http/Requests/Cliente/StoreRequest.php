<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'NomClie' => ['required'],
            'AppClie' => ['required'],
            'ApmClie' => ['required'],
            'EmaClie' => ['required', 'unique:clientes,EmaClie'],
            'DniClie' => ['required', 'unique:clientes,DniClie'],
            'FnaClie' => ['required'],
            'CelClie' => ['required', 'unique:clientes,CelClie'],
            'localidad' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'EmaClie.unique' => 'El correo electrónico ya está registrado.',
            'DniClie.unique' => 'El DNI ya ha sido registrado.',
            'CelClie.unique' => 'El número de teléfono ya está registrado.',
        ];
    }
}
