<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservacionController extends Controller
{
    /**
     * Muestra el formulario de reservación.
     */
    public function mostrarFormularioReservacion($hotel_id)
    {
        $hotel = DB::table('hoteles')->where('id', $hotel_id)->first();

        if (!$hotel) {
            return redirect()->route('hoteles.resultados')->with('error', 'Hotel no encontrado.');
        }

        return view('reservaciones.formulario', compact('hotel'));
    }

    /**
     * Procesa la reservación después de confirmar.
     */
    public function confirmarReservacion(Request $request, $hotel_id)
    {
        $validated = $request->validate([
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);
        $diasReservados = (new \DateTime($validated['fecha_fin']))->diff(new \DateTime($validated['fecha_inicio']))->days;
        DB::table('reservaciones')->insert([
            'hotel_id' => $hotel_id,
            'user_id' => auth()->id(),
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
            'total_dias' => $diasReservados,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('hoteles.resultados')->with('success', 'Reservación realizada con éxito.');
    }
}
