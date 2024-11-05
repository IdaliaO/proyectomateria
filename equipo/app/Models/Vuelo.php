<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    use HasFactory;

    protected $table = 'vuelos';

    protected $fillable = [
        'origen',
        'destino',
        'fecha_salida',
        'fecha_regreso',
        'capacidad',
        'clase',
        'aerolinea',
        'precio',
        'escalas',
        'hora_salida',
        'hora_llegada',
        'disponibilidad',
    ];
}
