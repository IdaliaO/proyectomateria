<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ConfirmarReservacionRequest; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vuelo;
use App\Models\ReservacionVuelo;


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
        if (!$usuarioId) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para reservar.');
        }
    
        $reservacionesHoteles = DB::table('reservaciones')
            ->join('hoteles', 'reservaciones.hotel_id', '=', 'hoteles.id')
            ->select(
                'reservaciones.*',
                'hoteles.nombre as hotel_nombre',
                'hoteles.precio_noche',
                'reservaciones.adultos',
                'reservaciones.ninos',
                'reservaciones.fecha_inicio',  
                'reservaciones.fecha_fin'      
            )
            ->where('reservaciones.user_id', $usuarioId)
            ->get();
    
        foreach ($reservacionesHoteles as $reservacion) {
            $fechaInicio = \Carbon\Carbon::parse($reservacion->fecha_inicio);
            $fechaFin = \Carbon\Carbon::parse($reservacion->fecha_fin);
            $reservacion->noches = $fechaInicio->diffInDays($fechaFin);  
        }
    
        $reservacionesVuelos = DB::table('reservaciones_vuelos')
            ->join('vuelos', 'reservaciones_vuelos.vuelo_id', '=', 'vuelos.id')
            ->select(
                'reservaciones_vuelos.*',
                'vuelos.numero_vuelo',
                'vuelos.aerolinea',
                'vuelos.precio'
            )
            ->where('reservaciones_vuelos.user_id', $usuarioId)
            ->get();
    
        return view('reservaciones.carrito', [
            'reservacionesHoteles' => $reservacionesHoteles,
            'reservacionesVuelos' => $reservacionesVuelos
        ]);
    }
    

    public function agregar(Request $request)
    {
        $vueloId = $request->input('vuelo_id');

        $vuelo = Vuelo::findOrFail($vueloId);

        $usuarioId = Session::get('usuario.id');
        if (!$usuarioId) {
            return redirect()->route('login.mostrar')->with('error', 'Debes iniciar sesión para reservar.');
        }

        $reservacion = new ReservacionVuelo();  
        $reservacion->usuario_id = $usuarioId;  
        $reservacion->vuelo_id = $vuelo->id;
        $reservacion->save();

        return redirect()->route('carrito')->with('success', 'Reservación de vuelo confirmada.');
    }
}


