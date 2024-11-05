<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Requests\RegistroUsuarioRequest;
use App\Http\Requests\LoginUsuarioRequest;
use App\Http\Requests\RecuperarContrasenaRequest;
use App\Mail\ConfirmacionRegistro;
use App\Mail\RecuperacionContrasena;
use App\Mail\DobleAutenticacion;

class UsuarioController extends Controller
{
    // Mostrar formulario de registro
    public function mostrarRegistro()
    {
        return view('auth.registro'); // resources/views/auth/registro.blade.php
    }

    // Registrar un nuevo usuario
    public function registrar(RegistroUsuarioRequest $request)
    {
        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => bcrypt($request->password),
        ]);
        // Enviar correo de confirmación de registro
        Mail::to($usuario->email)->send(new ConfirmacionRegistro($usuario));

        return redirect()->route('inicio')->with('success', 'Usuario registrado exitosamente. Por favor revisa tu correo para confirmar tu cuenta.');
    }

    // Mostrar formulario de inicio de sesión
  // UsuarioController.php
public function mostrarLogin()
{
    return view('auth.login'); // resources/views/auth/login.blade.php
}


    // Autenticar usuario
    public function autenticar(LoginUsuarioRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('inicio')->with('success', 'Inicio de sesión exitoso.');
        }
    
        return back()->with('error', 'Credenciales incorrectas.');
    }
    
           

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Mostrar formulario de recuperación de contraseña
    public function mostrarRecuperar()
    {
        return view('auth.recuperar'); // resources/views/auth/recuperar.blade.php
    }

    // Enviar enlace de recuperación de contraseña
    public function recuperar(RecuperarContrasenaRequest $request)
    {
        $usuario = User::where('email', $request->email)->first();
        if ($usuario) {
            // Enviar correo de recuperación de contraseña
            Mail::to($usuario->email)->send(new RecuperacionContrasena($usuario));
            return back()->with('success', 'Se ha enviado un enlace de recuperación de contraseña.');
        }

        return back()->withErrors(['email' => 'No se encontró un usuario con ese correo electrónico.']);
    }
}
