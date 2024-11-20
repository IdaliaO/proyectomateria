<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\HotelRequest;

class HotelController extends Controller
{
   

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
