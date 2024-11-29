<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarVueloRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha_salida' => 'required|date|after_or_equal:today',
            'fecha_llegada' => 'nullable|date|after_or_equal:fecha_salida',
            'pasajeros' => 'required|integer|min:1',
            'clase' => 'required|in:economica,ejecutiva,primera',
            'aerolinea' => 'nullable|string|max:255',
            'precio' => 'nullable|numeric|min:0',
            'escalas' => 'nullable|integer|in:0,1,2',
        ];
    }

    public function messages()
    {
        return [
            'origen.required' => 'El origen es obligatorio.',
            'destino.required' => 'El destino es obligatorio.',
            'fecha_salida.required' => 'La fecha de salida es obligatoria.',
            'fecha_salida.after_or_equal' => 'La fecha de salida debe ser hoy o una fecha futura.',
            'fecha_llegada.after_or_equal' => 'La fecha de regreso debe ser posterior o igual a la fecha de salida.',
            'pasajeros.required' => 'El número de pasajeros es obligatorio.',
            'pasajeros.min' => 'Debe haber al menos un pasajero.',
            'clase.required' => 'La clase es obligatoria.',
            'clase.in' => 'La clase seleccionada no es válida.',
            'precio.min' => 'El precio máximo debe ser igual o mayor a 0.',
            'escalas.in' => 'Las opciones de escalas no son válidas.',
        ];
    }
}
