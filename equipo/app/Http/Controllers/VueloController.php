<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BuscarVueloRequest;
use App\Models\Vuelo;

class VueloController extends Controller
{
    public function inicio()
    {
        return view('home'); // Asegúrate de que 'home' es el nombre de la vista de inicio.
    }
    public function mostrarFormularioBusqueda()
    {
        return view('vuelos.buscar');
    }
    // Procesar la búsqueda de vuelos
    public function buscar(BuscarVueloRequest $request)
    {
        // Consulta básica de vuelos
        $query = Vuelo::query();
    
        // Aplicar los filtros si están presentes en la solicitud
        if ($request->filled('origen')) {
            $query->where('origen', 'like', '%' . $request->origen . '%');
        }
        if ($request->filled('destino')) {
            $query->where('destino', 'like', '%' . $request->destino . '%');
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
            $query->where('aerolinea', 'like', '%' . $request->aerolinea . '%');
        }
        if ($request->filled('precio_maximo')) {
            $query->where('precio', '<=', $request->precio_maximo);
        }
        if ($request->filled('escalas')) {
            $query->where('escalas', $request->escalas);
        }
    
        // Obtener resultados
        $resultados = $query->get();
    
        return view('vuelos.resultados', compact('resultados'));
    }
    

    
}