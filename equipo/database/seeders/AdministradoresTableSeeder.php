<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministradoresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('administradores')->insert([
            'nombre' => 'Idalia Karina Olvera Cruz',
            'email' => '122042621@upq.edu.mx',
            'password' => Hash::make('160420'), // Asegúrate de cambiar la contraseña por una segura
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
