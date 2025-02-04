<?php

namespace App\Http\Requests\Cuestionario;

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
            'CodClie' => ['required'],
            'CodUsu' => ['required'],
            'Pre1' => ['required'],
            'Pre2' => ['required'],
            'Pre3' => ['required'],
            'Pre4' => ['required'],
            'Pre5' => ['required'],
            'Pre6' => ['required'],
            'Pre7' => ['required'],
            'Pre8' => ['required'],
            'Pre9' => ['required'],
            'Pre10' => ['required'],
            'Pre11' => ['required'],
            'Pre12' => ['required'],
            'Pre13' => [''],
            'ObsPre' => ['']
        ];
    }
}
