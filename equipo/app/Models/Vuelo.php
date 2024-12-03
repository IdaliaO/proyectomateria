<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    protected $table = 'vuelos';

    // Define las columnas que pueden ser asignadas masivamente
    protected $fillable = [
        'numero_vuelo', 'aerolinea', 'fecha_salida', 'fecha_llegada', 'precio', 'escalas', 'disponibilidad'
    ];
}
