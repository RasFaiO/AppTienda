<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoRequest extends FormRequest
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
            'id_proveedor' => ['required'],
            'tipo_comprobante' => ['required','min:5','max:20'],
            'serie_comprobante' => ['max:7'],
            'num_comprobante' => ['required','max:10'],
            'id_articulo' => ['required'],
            'cantidad' => ['required'],
            'precio_compra' => ['required'],
            'precio_venta' => ['required']
        ];
    }
}
