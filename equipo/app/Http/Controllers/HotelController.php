<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BuscarHotelRequest;
use App\Models\Hotel;

class HotelController extends Controller
{
    // Mostrar el formulario de búsqueda de hoteles
    public function mostrarFormularioBusqueda()
    {
        return view('hoteles.buscar'); // resources/views/hoteles/buscar.blade.php
    }
    
    // Realizar la búsqueda de hoteles y mostrar los resultados
    public function buscar(BuscarHotelRequest $request)
    {
        $query = Hotel::query();

        // Aplicar filtros basados en los criterios de búsqueda
        if ($request->filled('destino')) {
            $query->where('destino', 'like', '%' . $request->destino . '%');
        }
        if ($request->filled('fecha_checkin') && $request->filled('fecha_checkout')) {
            // Supón que la disponibilidad se maneja de alguna forma en tu modelo de Hotel
            $query->whereDate('fecha_disponible', '>=', $request->fecha_checkin)
                  ->whereDate('fecha_disponible', '<=', $request->fecha_checkout);
        }
        if ($request->filled('huespedes')) {
            $query->where('capacidad', '>=', $request->huespedes);
        }
        if ($request->filled('categoria')) {
            $query->where('estrellas', $request->categoria);
        }
        if ($request->filled('precio_maximo')) {
            $query->where('precio_por_noche', '<=', $request->precio_maximo);
        }
        if ($request->filled('servicios')) {
            foreach ($request->servicios as $servicio) {
                $query->where('servicios', 'like', '%' . $servicio . '%');
            }
        }

        $resultados = $query->get();

        return view('hoteles.resultados', compact('resultados'));
    }
}
