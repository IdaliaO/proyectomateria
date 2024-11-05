<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarHotelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'destino' => 'required|string|max:255',
            'fecha_checkin' => 'required|date|after_or_equal:today',
            'fecha_checkout' => 'required|date|after:fecha_checkin',
            'huespedes' => 'required|integer|min:1',
            'categoria' => 'nullable|integer|min:1|max:5',
            'precio_maximo' => 'nullable|numeric|min:0',
            'servicios' => 'nullable|array'
        ];
    }

    public function messages()
    {
        return [
            'destino.required' => 'El destino es obligatorio.',
            'fecha_checkin.required' => 'La fecha de check-in es obligatoria.',
            'fecha_checkout.required' => 'La fecha de check-out es obligatoria.',
            'huespedes.required' => 'El número de huéspedes es obligatorio.',
        ];
    }
}
