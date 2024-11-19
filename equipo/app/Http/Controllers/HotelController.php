<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\HotelRequest;

class HotelController extends Controller
{
    public function listarHoteles()
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la gestión de hoteles.');
        }

        $hoteles = DB::table('hoteles')->get();
        return view('admin.hoteles.index', compact('hoteles'));
    }
    public function crearHotelFormulario()
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la creación de hoteles.');
        }

        return view('admin.hoteles.crear');
    }

    public function crearHotel(HotelRequest $request)
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }
        DB::table('hoteles')->insert([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'categoria' => $request->categoria,
            'precio_noche' => $request->precio_noche,
            'disponibilidad' => $request->disponibilidad,
            'servicios' => json_encode($request->servicios), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('admin.hoteles.index')->with('success', 'Hotel creado correctamente.');
    }
    public function eliminarHotel($id)
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        DB::table('hoteles')->where('id', $id)->delete();
        return redirect()->route('admin.hoteles.index')->with('success', 'Hotel eliminado correctamente.');
    }
    public function mostrarHotel($id)
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la información del hotel.');
        }

        $hotel = DB::table('hoteles')->where('id', $id)->first();
        if (!$hotel) {
            return redirect()->route('admin.hoteles.index')->with('error', 'Hotel no encontrado.');
        }

        return view('admin.hoteles.mostrar', compact('hotel'));
    }
    public function buscarHoteles(HotelRequest $request)
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
            foreach ($request->servicios as $servicio) {
                $query->where('servicios', 'LIKE', '%' . $servicio . '%');
            }
        }

        $hoteles = $query->get();

        return view('hoteles.resultados', compact('hoteles'));
    }
}
