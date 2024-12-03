<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservacionVuelo extends Model
{
    // Definir la tabla asociada al modelo
    protected $table = 'reservaciones_vuelos';

    // Los campos que pueden ser asignados masivamente
    protected $fillable = ['usuario_id', 'vuelo_id'];
}
