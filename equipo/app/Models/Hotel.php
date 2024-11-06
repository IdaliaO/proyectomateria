<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'destino',
        'numero_estrellas',
        'precio_por_noche',
        'capacidad',
        'distancia_centro',
        'servicios',
        'calificacion',
        'descripcion',
        'politicas_cancelacion',
        'fecha_disponible_desde',
        'fecha_disponible_hasta',
    ];

    protected $casts = [
        'servicios' => 'array',
    ];

}
