<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BuscarHotelRequest;

class HotelController extends Controller
{
    /**
     * Muestra el formulario para buscar hoteles.
     */
    public function buscarHoteles()
    {
        $servicios = DB::table('servicios')->get(); // Cargar todos los servicios
        return view('hoteles.buscar', compact('servicios'));
    }

    /**
     * Muestra los resultados de búsqueda de hoteles.
     */
    public function resultadosHoteles(BuscarHotelRequest $request)
{
    $query = DB::table('hoteles')->select('id', 'nombre', 'ubicacion', 'precio_noche', 'categoria', 'fotografia');
    if ($request->filled('destino')) {
        $query->where('ubicacion', 'LIKE', '%' . $request->destino . '%');
    }
    if ($request->filled('precio_noche_max')) {
        $query->where('precio_noche', '<=', (float)$request->precio_noche_max);
    }
    if ($request->filled('categoria')) {
        $query->where('categoria', $request->categoria);
    }
    if ($request->filled('servicios')) {
        $query->whereExists(function ($subQuery) use ($request) {
            $subQuery->select(DB::raw(1))
                ->from('hotel_servicio')
                ->whereColumn('hotel_servicio.hotel_id', 'hoteles.id')
                ->whereIn('hotel_servicio.servicio_id', $request->servicios);
        });
    }

    $resultados = $query->get();

    $servicios = DB::table('servicios')->get();

    return view('hoteles.resultados', compact('resultados', 'servicios'));
}

    /**
     * Muestra el detalle de un hotel específico.
     */
    public function mostrarDetalle($id)
    {
        $hotel = DB::table('hoteles')->where('id', $id)->first();

        if (!$hotel) {
            return redirect()->route('hoteles.buscar')->with('error', 'Hotel no encontrado.');
        }

        $servicios = DB::table('hotel_servicio')
            ->join('servicios', 'hotel_servicio.servicio_id', '=', 'servicios.id')
            ->where('hotel_servicio.hotel_id', $id)
            ->select('servicios.nombre')
            ->get();

        return view('hoteles.detalle', compact('hotel', 'servicios'));
    }
}
