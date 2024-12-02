<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentarioController extends Controller
{
    public function guardar(Request $request)
{
    $request->validate([
        'hotel_id' => 'required|exists:hoteles,id',
        'calificacion' => 'required|integer|min:1|max:5',
        'comentario' => 'required|string|max:500',
    ]);

    $usuario = session('usuario'); 

    if (!$usuario || !isset($usuario['id'])) {
        return redirect()->back()->with('error', 'Debes iniciar sesión para dejar un comentario.');
    }

    DB::table('comentarios')->insert([
        'hotel_id' => $request->hotel_id,
        'user_id' => $usuario['id'],
        'calificacion' => $request->calificacion,
        'comentario' => $request->comentario,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Tu comentario ha sido guardado exitosamente.');
}

}
