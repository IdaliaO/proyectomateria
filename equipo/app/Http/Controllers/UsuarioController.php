<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function mostrarRegistro()
    {
        return view('auth.registro');
    }

    public function registrar(Request $request)
    {
        DB::table('users')->insert([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => $request->password, 
            'updated_at' => now(),
        ]);
    
        return redirect()->route('registro.mostrar')->with('success', 'Usuario registrado exitosamente.');
    }
    
    
    
}
