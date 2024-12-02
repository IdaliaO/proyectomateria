<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmarReservacionRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'adultos' => 'required|integer|min:1',
            'ninos' => 'required|integer|min:0',
            'acepto_terminos' => 'accepted',
        ];
    }

    public function messages()
    {
        return [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser hoy o posterior.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'adultos.required' => 'El número de adultos es obligatorio.',
            'adultos.integer' => 'El número de adultos debe ser un número entero.',
            'adultos.min' => 'Debe haber al menos un adulto.',
            'ninos.required' => 'El número de niños es obligatorio.',
            'ninos.integer' => 'El número de niños debe ser un número entero.',
            'ninos.min' => 'El número de niños no puede ser negativo.',
            'acepto_terminos.accepted' => 'Debes aceptar los términos y condiciones.',
        ];
    }
}
