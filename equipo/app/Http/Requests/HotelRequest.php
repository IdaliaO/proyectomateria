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
        return [
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'categoria' => 'required|integer|min:1|max:5',
            'precio_noche' => 'required|numeric|min:0',
            'disponibilidad' => 'required|integer|min:1',
            'descripcion' => 'nullable|string',
            'politicas_cancelacion' => 'nullable|string',
            'fotografia' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'servicios' => 'nullable|array',
            'servicios.*' => 'exists:servicios,id', 
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del hotel es obligatorio.',
            'ubicacion.required' => 'La ubicación es obligatoria.',
            'categoria.required' => 'La categoría (estrellas) es obligatoria.',
            'precio_noche.required' => 'El precio por noche es obligatorio.',
            'disponibilidad.required' => 'La disponibilidad de habitaciones es obligatoria.',
            'fotografia.required' => 'La fotografía del hotel es obligatoria.',
            'fotografia.image' => 'La fotografía debe ser una imagen válida.',
            'servicios.exists' => 'Uno o más servicios seleccionados no son válidos.',
        ];
    }
}
