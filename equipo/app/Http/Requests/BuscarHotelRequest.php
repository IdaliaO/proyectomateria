<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarHotelRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Reglas de validación para la solicitud.
     */
    public function rules()
{
    return [
        'destino' => 'nullable|string|max:255',
        'precio_noche_max' => 'nullable|numeric|min:0', 
        'categoria' => 'nullable|integer|min:1|max:5',
        'servicios' => 'nullable|array',
        'servicios.*' => 'exists:servicios,id',
    ];
}

public function messages()
{
    return [
        'precio_noche_max.numeric' => 'El precio máximo debe ser un número válido.',
        'precio_noche_max.min' => 'El precio máximo no puede ser negativo.',
    ];
}

}
