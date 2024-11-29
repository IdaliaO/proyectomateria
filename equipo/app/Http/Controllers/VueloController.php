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
    public function resultadosVuelos(Request $request)
{
    $query = DB::table('vuelos');

    if ($request->filled('origen')) {
        $query->where('origen', 'like', '%' . $request->origen . '%');
    }
    if ($request->filled('destino')) {
        $query->where('destino', 'like', '%' . $request->destino . '%');
    }
    if ($request->filled('fecha_salida')) {
        $query->where('fecha_salida', '=', $request->fecha_salida);
    }
    if ($request->filled('fecha_llegada')) {
        $query->where('fecha_llegada', '=', $request->fecha_llegada);
    }
    if ($request->filled('disponibilidad')) {
        $query->where('disponibilidad', '>=', $request->disponibilidad);
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
    if (!is_null($request->escalas)) {
        $query->where('escalas', $request->escalas);
    }

    $resultados = $query->get();

    return view('vuelos.resultados', compact('resultados'));
}

    
}
