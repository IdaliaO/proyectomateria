<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VueloRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'aerolinea' => 'required|string|max:255',
            'numero_vuelo' => 'required|string|unique:vuelos,numero_vuelo',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after:fecha_salida',
            'precio' => 'required|numeric|min:0',
            'disponibilidad_asientos' => 'required|integer|min:1', 
            'clase' => 'required|in:economica,ejecutiva,primera',
            'escalas' => 'required|boolean',
            'politica_cancelacion' => 'nullable|string',
        ];
    }
    
}
