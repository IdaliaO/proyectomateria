<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Carbon;

class ServicioSeeder extends Seeder
{
    public function run()
    {
        $servicios = [
            'Alojamiento',
            'Recepción las 24 horas',
            'Limpieza de habitaciones',
            'Restaurante',
            'Lounge bar',
            'Wi-Fi',
            'Estacionamiento',
            'Piscina',
            'Gimnasio',
            'Lavandería y planchado',
        ];

        foreach ($servicios as $servicio) {
            DB::table('servicios')->insert([
                'nombre' => $servicio,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
