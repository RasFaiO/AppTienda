<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ArticuloRequest extends FormRequest
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
            'categorias_id' => ['required'],
            'codigo' => ['required','min:5','max:50'],
            'nombre'=> ['required','min:5','max:100'],
            'stock' => ['required','numeric'],
            'descripcion' => ['required','max:512'],
            'image_uri' => ['nullable', File::image()]
        ];
    }
}
