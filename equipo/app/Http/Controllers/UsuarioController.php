<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroUsuarioRequest;
use App\Http\Requests\LoginUsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


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
        $verificationToken = Str::random(60);

        // Insert user with verification token
        $userId = DB::table('users')->insertGetId([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'password' => $passwordCifrado,
            'email_verification_token' => $verificationToken,
            'email_verified_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Send verification email
        $this->enviarEmailVerificacion($validated['email'], $verificationToken);

        // Authenticate the user
        Session::put('autenticado', true);
        Session::put('usuario', [
            'id' => $userId,
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('verificar.email.mostrar');
    }

    private function enviarEmailVerificacion($email, $token)
    {
        $verificationUrl = route('verificar.email', ['token' => $token]);

        Mail::send('emails.verificacion', ['url' => $verificationUrl], function ($message) use ($email) {
            $message->to($email)
                ->subject('Verifica tu correo electrónico');
        });
    }

    public function verificarEmail($token)
    {
        $usuario = DB::table('users')
            ->where('email_verification_token', $token)
            ->first();

        if (!$usuario) {
            return redirect()->route('inicio')
                ->with('error', 'El enlace de verificación no es válido.');
        }

        // Update user as verified
        DB::table('users')
            ->where('id', $usuario->id)
            ->update([
                'email_verified_at' => now(),
                'email_verification_token' => null
            ]);

        // Authenticate the user
        Session::put('autenticado', true);
        Session::put('usuario', [
            'id' => $usuario->id,
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'email' => $usuario->email,
        ]);

        return redirect()->route('inicio')
            ->with('success', 'Email verificado correctamente. ¡Bienvenido!');
    }

    public function verificarEmailManual(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $usuario = DB::table('users')
            ->where('email_verification_token', $request->token)
            ->first();

        if (!$usuario) {
            return redirect()->route('verificar.email.mostrar')
                ->with('error', 'El token ingresado no es válido.');
        }

        // Marcar el email como verificado
        DB::table('users')
            ->where('id', $usuario->id)
            ->update([
                'email_verified_at' => now(),
                'email_verification_token' => null,
            ]);

        // Autenticar al usuario
        Session::put('autenticado', true);
        Session::put('usuario', [
            'id' => $usuario->id,
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'email' => $usuario->email,
        ]);

        return redirect()->route('inicio')
            ->with('success', 'Email verificado correctamente. ¡Bienvenido!');
    }

    public function mostrarVerificacion()
    {
        return view('verificar-email');
    }

    public function mostrarLogin()
    {
        return view('login');
    }

    public function autenticar(LoginUsuarioRequest $request)
    {
        $validated = $request->validated();
        $usuario = DB::table('users')
            ->where('email', $validated['email'])
            ->first();
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

    public function reenviarVerificacion(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $usuario = DB::table('users')
            ->where('email', $request->email)
            ->whereNull('email_verified_at')
            ->first();

        if (!$usuario) {
            return back()->with('error', 'No se encontró un usuario sin verificar con ese email.');
        }

        // Generate new token
        $newToken = Str::random(60);

        DB::table('users')
            ->where('id', $usuario->id)
            ->update(['email_verification_token' => $newToken]);

        // Resend email
        $this->enviarEmailVerificacion($usuario->email, $newToken);

        return back()->with('success', 'Se ha enviado un nuevo enlace de verificación a tu email.');
    }
}