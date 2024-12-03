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
            'disponibilidad' => 'required|integer|min:1', 
            'clase' => 'required|in:economica,ejecutiva,primera',
            'escalas' => 'required|boolean',
            'politica_cancelacion' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'aerolinea.required' => 'El nombre de la aerolínea es obligatorio.',
            'aerolinea.string' => 'El nombre de la aerolínea debe ser una cadena de texto.',
            'aerolinea.max' => 'El nombre de la aerolínea no debe exceder 255 caracteres.',

            'numero_vuelo.required' => 'El número de vuelo es obligatorio.',
            'numero_vuelo.string' => 'El número de vuelo debe ser una cadena de texto.',
            'numero_vuelo.unique' => 'El número de vuelo ya está registrado.',

            'origen.required' => 'El origen del vuelo es obligatorio.',
            'origen.string' => 'El origen debe ser una cadena de texto.',
            'origen.max' => 'El origen no debe exceder 255 caracteres.',

            'destino.required' => 'El destino del vuelo es obligatorio.',
            'destino.string' => 'El destino debe ser una cadena de texto.',
            'destino.max' => 'El destino no debe exceder 255 caracteres.',

            'fecha_salida.required' => 'La fecha de salida es obligatoria.',
            'fecha_salida.date' => 'La fecha de salida debe ser una fecha válida.',

            'fecha_llegada.required' => 'La fecha de llegada es obligatoria.',
            'fecha_llegada.date' => 'La fecha de llegada debe ser una fecha válida.',
            'fecha_llegada.after' => 'La fecha de llegada debe ser posterior a la fecha de salida.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio no puede ser menor que 0.',

            'disponibilidad.required' => 'La disponibilidad de asientos es obligatoria.',
            'disponibilidad.integer' => 'La disponibilidad debe ser un número entero.',
            'disponibilidad.min' => 'Debe haber al menos 1 asiento disponible.',

            'clase.required' => 'La clase del vuelo es obligatoria.',
            'clase.in' => 'La clase debe ser: económica, ejecutiva o primera.',

            'escalas.required' => 'Debe especificar si el vuelo tiene escalas.',
            'escalas.boolean' => 'El valor de escalas debe ser verdadero o falso.',

            'politica_cancelacion.string' => 'Las políticas de cancelación deben ser una cadena de texto.',
        ];
    }
}
