<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroUsuarioRequest;
use App\Http\Requests\LoginUsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }

    public function mostrarRegistro()
    {
        return view('registro');
    }

    public function registrar(RegistroUsuarioRequest $request)
    {
        $validated = $request->validated();
        $passwordCifrado = Hash::make($validated['password']);
        DB::table('users')->insert([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'password' => $passwordCifrado,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Session::put('autenticado', true);
        Session::put('usuario', [
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('inicio')->with('success', 'Usuario registrado exitosamente.');
    }

    public function mostrarLogin()
    {
        return view('login');
    }

    public function autenticar(LoginUsuarioRequest $request)
    {
        $validated = $request->validated();

        // Buscar el usuario por email
        $usuario = DB::table('users')
            ->where('email', $validated['email'])
            ->first();

        // Verificar si la contraseña es correcta
        if ($usuario && Hash::check($validated['password'], $usuario->password)) {
            Session::put('autenticado', true);
            Session::put('usuario', [
                'id' => $usuario->id,
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'email' => $usuario->email,
            ]);
            return redirect()->route('inicio')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->with('error', 'Credenciales incorrectas.');
    }

    public function logout()
    {
        Session::forget('autenticado');
        Session::forget('usuario');

        return redirect()->route('inicio')->with('success', 'Sesión cerrada correctamente.');
    }
}
