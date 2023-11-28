<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
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
            //
            'nombre' => ['required','min:5','max:100'],
            'tipo_documento'=> ['required','min:2','max:20'],
            'num_documento' => ['required','max:15'],
            'direccion'=> ['min:5','max:70'],
            'telefono' => ['max:15'],
            'email' => ['max:50']
        ];
    }
}
