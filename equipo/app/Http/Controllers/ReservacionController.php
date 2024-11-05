<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vuelo;
use Session;

class ReservacionController extends Controller
{
    public function agregarAlCarrito(Request $request)
    {
        $vuelo = Vuelo::findOrFail($request->vuelo_id);

        // Agregar al carrito en la sesión
        $carrito = session()->get('carrito', []);
        $carrito[] = $vuelo;
        session()->put('carrito', $carrito);

        return redirect()->route('carrito')->with('success', 'Vuelo agregado al carrito exitosamente.');
    }

    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        return view('reservas.carrito', compact('carrito'));
    }
}
