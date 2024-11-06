<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BuscarHotelRequest;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function mostrarFormularioBusqueda()
    {
        return view('hoteles.buscar');
    }
    public function buscar(BuscarHotelRequest $request)
    {
        \Log::info('Búsqueda de hotel iniciada', $request->all());
        $query = Hotel::query();
        if ($request->filled('destino')) {
            $query->where('destino', 'like', '%' . $request->destino . '%');
        }
        if ($request->filled('fecha_checkin') && $request->filled('fecha_checkout')) {
            $query->where('fecha_disponible_desde', '<=', $request->fecha_checkin)
                  ->where('fecha_disponible_hasta', '>=', $request->fecha_checkout);
        }
        if ($request->filled('huespedes')) {
            $query->where('capacidad', '>=', $request->huespedes);
        }
        if ($request->filled('categoria')) {
            $query->where('numero_estrellas', $request->categoria);
        }
        if ($request->filled('precio_minimo')) {
            $query->where('precio_por_noche', '>=', $request->precio_minimo);
        }
        if ($request->filled('precio_maximo')) {
            $query->where('precio_por_noche', '<=', $request->precio_maximo);
        }
        if ($request->filled('distancia_maxima')) {
            $query->where('distancia_centro', '<=', $request->distancia_maxima);
        }
        if ($request->filled('servicios')) {
            foreach ($request->servicios as $servicio) {
                $query->whereJsonContains('servicios', $servicio);
            }
        }
        $resultados = $query->get();
        if ($resultados->isEmpty()) {
            \Log::info('No se encontraron resultados para la búsqueda de hoteles.');
        } else {
            \Log::info('Se encontraron resultados para la búsqueda de hoteles.', ['resultados' => $resultados]);
        }
        return view('hoteles.resultados', compact('resultados'));
    }
    public function mostrarDetalle($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('hoteles.detalle', compact('hotel'));
    }
}
