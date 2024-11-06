<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginUsuarioRequest;
use App\Http\Requests\RegistroUsuarioRequest;

class UsuarioController extends Controller
{
    public function mostrarRegistro()
    {
        return view('auth.registro');
    }
    public function registrar(RegistroUsuarioRequest $request)
    {
        $usuario = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => bcrypt($request->password), 
        ];
        Session::put('usuario', $usuario);
        return redirect()->route('registro.mostrar')->with('success', 'Usuario registrado exitosamente.');
    }
    public function mostrarLogin()
    {
        return view('auth.login');
    }
    public function autenticar(LoginUsuarioRequest $request)
    {
        if ($request->filled('email') && $request->filled('password')) {
            Session::put('autenticado', true);
            return redirect()->route('inicio')->with('success', 'Inicio de sesión exitoso.');
        }
        return back()->with('error', 'Credenciales incorrectas.');
    }

    public function logout()
    {
        Session::forget('autenticado');

        return redirect()->route('login.mostrar')->with('success', 'Sesión cerrada correctamente.');
    }
}
