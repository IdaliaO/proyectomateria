<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BuscarVueloRequest;

class VueloController extends Controller
{
    // Mostrar el formulario de búsqueda de vuelos
    public function buscarVuelos()
    {
        return view('vuelos.buscar');
    }

    // Mostrar resultados de búsqueda de vuelos
    public function resultadosVuelos(BuscarVueloRequest $request)
    {
        $query = DB::table('vuelos');

        if ($request->filled('origen')) {
            $query->where('origen', 'LIKE', '%' . $request->origen . '%');
        }
        if ($request->filled('destino')) {
            $query->where('destino', 'LIKE', '%' . $request->destino . '%');
        }
        if ($request->filled('fecha_salida')) {
            $query->whereDate('fecha_salida', $request->fecha_salida);
        }
        if ($request->filled('fecha_regreso')) {
            $query->whereDate('fecha_regreso', $request->fecha_regreso);
        }
        if ($request->filled('pasajeros')) {
            $query->where('capacidad', '>=', $request->pasajeros);
        }
        if ($request->filled('clase')) {
            $query->where('clase', $request->clase);
        }
        if ($request->filled('aerolinea')) {
            $query->where('aerolinea', 'LIKE', '%' . $request->aerolinea . '%');
        }
        if ($request->filled('precio')) {
            $query->where('precio', '<=', $request->precio);
        }
        if ($request->filled('escalas')) {
            $query->where('escalas', $request->escalas);
        }

        $resultados = $query->get();
        return view('vuelos.resultados', compact('resultados'));
    }
}
