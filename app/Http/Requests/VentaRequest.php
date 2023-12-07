<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
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
            'cliente_id' => ['required'],
            'tipo_comprobante' => ['required','max:20'],
            'serie_comprobante' => ['max:7'],
            'num_comprobante' => ['required','max:10'],
            // detalles de ventas
            'total_venta' => ['required'],
            'articulo_id' => ['required'],
            'cantidad' => ['required'],
            'precio_venta' => ['required'],
            'descuento' => ['required'],
        ];
    }
}
