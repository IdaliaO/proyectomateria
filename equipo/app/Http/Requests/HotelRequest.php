<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'nombre' => 'required|string|max:255',
                    'ubicacion' => 'required|string|max:255',
                    'categoria' => 'required|integer|min:1|max:5',
                    'precio_noche' => 'required|numeric|min:0',
                    'disponibilidad' => 'required|integer|min:1',
                    'servicios' => 'nullable|array',
                    'servicios.*' => 'string',
                    'descripcion' => 'nullable|string|max:1000',
                    'politicas_cancelacion' => 'nullable|string|max:1000',
                    'numero_estrellas' => 'required|integer|min:1|max:5',
                    'check_in' => 'required|date',
                    'check_out' => 'required|date|after:check_in',
                    'numero_habitaciones' => 'required|integer|min:1',
                    'numero_huespedes' => 'required|integer|min:1',
                ];
            case 'GET':
                return [
                    'destino' => 'nullable|string|max:255',
                    'categoria' => 'nullable|integer|min:1|max:5',
                    'precio_min' => 'nullable|numeric|min:0',
                    'precio_max' => 'nullable|numeric|min:0',
                    'servicios' => 'nullable|array',
                    'servicios.*' => 'string',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del hotel es obligatorio.',
            'ubicacion.required' => 'La ubicación del hotel es obligatoria.',
            'categoria.required' => 'La categoría del hotel es obligatoria.',
            'categoria.integer' => 'La categoría debe ser un número entero entre 1 y 5.',
            'precio_noche.required' => 'El precio por noche es obligatorio.',
            'precio_noche.numeric' => 'El precio por noche debe ser un número.',
            'disponibilidad.required' => 'La disponibilidad de habitaciones es obligatoria.',
            'disponibilidad.integer' => 'La disponibilidad debe ser un número entero.',
            'servicios.array' => 'Los servicios deben ser una lista válida.',
            'descripcion.max' => 'La descripción no debe exceder los 1000 caracteres.',
            'politicas_cancelacion.max' => 'Las políticas de cancelación no deben exceder los 1000 caracteres.',
            'numero_estrellas.required' => 'El número de estrellas es obligatorio.',
            'numero_estrellas.integer' => 'El número de estrellas debe ser un valor entre 1 y 5.',
            'check_in.required' => 'La fecha de check-in es obligatoria.',
            'check_in.date' => 'La fecha de check-in debe ser una fecha válida.',
            'check_out.required' => 'La fecha de check-out es obligatoria.',
            'check_out.date' => 'La fecha de check-out debe ser una fecha válida.',
            'check_out.after' => 'La fecha de check-out debe ser posterior a la fecha de check-in.',
            'numero_habitaciones.required' => 'El número de habitaciones es obligatorio.',
            'numero_habitaciones.integer' => 'El número de habitaciones debe ser un valor entero válido.',
            'numero_huespedes.required' => 'El número de huéspedes es obligatorio.',
            'numero_huespedes.integer' => 'El número de huéspedes debe ser un valor entero válido.',
        ];
    }
}
