<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\HotelRequest;

class HotelController extends Controller
{
    // Mostrar el formulario de búsqueda de hoteles
    public function buscarHoteles()
    {
        $servicios = DB::table('servicios')->get();
        return view('hoteles.buscar', compact('servicios'));
    }

    // Mostrar resultados de búsqueda de hoteles
    public function resultadosHoteles(HotelRequest $request)
    {
        $query = DB::table('hoteles');

        if ($request->filled('destino')) {
            $query->where('ubicacion', 'LIKE', '%' . $request->destino . '%');
        }
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }
        if ($request->filled('precio_min') && $request->filled('precio_max')) {
            $query->whereBetween('precio_noche', [$request->precio_min, $request->precio_max]);
        }
        if ($request->filled('servicios')) {
            $query->whereExists(function ($subQuery) use ($request) {
                $subQuery->select(DB::raw(1))
                    ->from('hotel_servicio')
                    ->whereColumn('hotel_servicio.hotel_id', 'hoteles.id')
                    ->whereIn('hotel_servicio.servicio_id', $request->servicios);
            });
        }

        $hoteles = $query->get();
        return view('hoteles.resultados', compact('hoteles'));
    }

    // Mostrar detalles de un hotel específico
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
