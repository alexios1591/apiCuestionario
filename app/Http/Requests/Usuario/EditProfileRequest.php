<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'NomUsu' => ['required', 'string', 'min:2'],
            'AppUsu' => ['required', 'string', 'min:2'],
            'ApmUsu' => ['required', 'string', 'min:2'],
            'DocUsu' => [
                'required',
                'string',
                'regex:/^\d{8,10}$/',
                'unique:usuario,DocUsu,' . $this->route('usuario'). ',CodUsu'
            ],
            'EmaUsu' => [
                'required',
                'email',
                'unique:usuario,EmaUsu,' . $this->route('usuario'). ',CodUsu'
            ],
            'CelUsu' => [
                'required',
                'string',
                'regex:/^\d{9,12}$/',
                'unique:usuario,CelUsu,' . $this->route('usuario'). ',CodUsu'
            ],
        ];
    }
}
