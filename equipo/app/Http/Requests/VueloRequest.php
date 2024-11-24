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
    public function messages()
    {
        return [
            'aerolinea.required' => 'El nombre de la aerolinea es obligatoria.',
            'numero_vuelo.required' => 'Introduce un numero de vuelo valido .',
            'origen' => 'El origen del vuelo es obligatorio',
            'destino' => 'El destino del vuelo es obligatorio.',
            'fecha_salida' => 'Ingresa una fecha de salida valida',
            'fecha_llegada' => 'Ingresa una fecha de llegada valida',
            'precio' => 'La disponibilidad de habitaciones es obligatoria.',
            'disponibilidad_asientos' => 'La cantidad de asientos es obligatoria.',
            'clase' =>'Obligatorio la clase del vuelo.',
            'escalas' => 'Determine si es con escalas o sin escalar, obligatorio.',
            'politica_cancelacion' => 'Las politicas de cancelacion son obligatorias.',
        ];
    
}
}
