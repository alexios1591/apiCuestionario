<?php

namespace App\Http\Requests\Usuario;

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
            'NomUsu' => ['required'],
            'AppUsu' => ['required'],
            'ApmUsu' => ['required'],
            'DocUsu' => ['required', 'unique:usuario,DocUsu,' . $this->CodUsu . ',CodUsu'],
            'EmaUsu' => ['required', 'unique:usuario,EmaUsu,' . $this->CodUsu . ',CodUsu'],
            'CelUsu' => ['required', 'unique:usuario,CelUsu,' . $this->CodUsu . ',CodUsu'],
            'sexUsu' => ['required'],
            'FnaUsu' => ['required']
        ];
    }


    public function messages()
    {
        return [
            'DocUsu.unique' => 'El DNI ya ha sido registrado.',
            'EmaUsu.unique' => 'El correo electrónico ya está registrado.',
            'CelUsu.unique' => 'El número ya está registrado.',
        ];
    }

}


