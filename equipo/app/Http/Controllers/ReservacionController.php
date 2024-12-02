<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ConfirmarReservacionRequest; 
use Illuminate\Support\Facades\DB;

class ReservacionController extends Controller
{
    public function mostrarFormularioReservacion($hotel_id)
    {
        $hotel = DB::table('hoteles')->find($hotel_id);

        if (!$hotel) {
            return redirect()->route('inicio')->with('error', 'Hotel no encontrado.');
        }

        return view('reservaciones.formulario', compact('hotel'));
    }

    public function confirmarReservacion(ConfirmarReservacionRequest $request, $hotel_id)
    {
        $validated = $request->validated();
    
        $usuarioId = Session::get('usuario.id');
        if (!$usuarioId) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para reservar.');
        }
    
        $precioPorNoche = DB::table('hoteles')->where('id', $hotel_id)->value('precio_noche');
    
        $noches = (new \DateTime($validated['fecha_fin']))->diff(new \DateTime($validated['fecha_inicio']))->days;
        $totalPersonas = $validated['adultos'] + $validated['ninos'];
        $habitacionesNecesarias = ceil($totalPersonas / 4);
        $costoTotal = $noches * $habitacionesNecesarias * $precioPorNoche;
    
        DB::table('reservaciones')->insert([
            'hotel_id' => $hotel_id,
            'user_id' => $usuarioId,
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
            'adultos' => $validated['adultos'],
            'ninos' => $validated['ninos'],
            'total_dias' => $noches,
            'costo_total' => $costoTotal,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('carrito')->with('success', 'Reservación confirmada.');
    }
    
    public function mostrarCarrito()
    {
        $usuarioId = Session::get('usuario.id'); 
        $reservaciones = DB::table('reservaciones')
            ->join('hoteles', 'reservaciones.hotel_id', '=', 'hoteles.id')
            ->select(
                'reservaciones.*',
                'hoteles.nombre as hotel_nombre',
                'hoteles.precio_noche'
            )
            ->where('reservaciones.user_id', $usuarioId)
            ->get();
    
        return view('reservaciones.carrito', ['reservaciones' => $reservaciones]);
    }
    

    
    
}

    

