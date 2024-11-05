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
        'categoria',
        'precio_noche',
        'disponibilidad',
        'distancia_centro',
        'servicios', // Esto puede ser una columna JSON que almacena múltiples servicios como 'wifi', 'piscina', etc.
        'calificacion',
        'numero_estrellas',
        // Otros campos necesarios
    ];
}
