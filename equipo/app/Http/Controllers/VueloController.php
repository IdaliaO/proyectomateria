<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BuscarVueloRequest;

class VueloController extends Controller
{
    public function buscarVuelos()
    {
  
        return view('vuelos.buscar');
    }

    public function resultadosVuelos(BuscarVueloRequest $request)
    {
        $query = DB::table('vuelos');

        if ($request->filled('origen')) {
            $query->where('origen', 'like', '%' . $request->origen . '%');
        }

        if ($request->filled('destino')) {
            $query->where('destino', 'like', '%' . $request->destino . '%');
        }

        if ($request->filled('fecha_salida')) {
            $query->where('fecha_salida', $request->fecha_salida);
        }

        if ($request->filled('fecha_regreso')) {
            $query->where('fecha_regreso', $request->fecha_regreso);
        }

        if ($request->filled('pasajeros')) {
            $query->where('capacidad', '>=', $request->pasajeros);
        }

        if ($request->filled('clase')) {
            $query->where('clase', $request->clase);
        }

        if ($request->filled('aerolinea')) {
            $query->where('aerolinea', 'like', '%' . $request->aerolinea . '%');
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
