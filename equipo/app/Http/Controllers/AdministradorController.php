<?php

namespace App\Http\Controllers;

use App\Http\Requests\VueloRequest;
use App\Http\Requests\HotelRequest;
use App\Http\Requests\RegistroAdministradorRequest; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PDF;
use Excel;
use App\Exports\ReportExport;
use App\Http\Controllers\Controller;

class AdministradorController extends Controller
{
    public function mostrarLogin()
    {
        return view('admin.login');
    }

    public function autenticar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $admin = DB::table('administradores')->where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_autenticado', true);
            Session::put('admin', [
                'id' => $admin->id,
                'nombre' => $admin->nombre,
                'email' => $admin->email,
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->with('error', 'Credenciales incorrectas.');
    }

    public function logout()
    {
        Session::forget('admin_autenticado');
        Session::forget('admin');

        return redirect()->route('admin.login')->with('success', 'Sesión cerrada correctamente.');
    }

    public function dashboard()
    {
        if (!Session::get('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debes iniciar sesión para acceder al panel de administración.');
        }

        return view('admin.dashboard');
    }

    public function listarUsuarios()
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la gestión de usuarios.');
        }

        $usuarios = DB::table('users')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function crearUsuarioFormulario()
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la creación de usuarios.');
        }

        return view('admin.usuarios.crear');
    }

    public function crearUsuario(Request $request)
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|min:10|max:15',
            'password' => 'required|string|min:6',
        ]);

        DB::table('users')->insert([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function eliminarUsuario($id)
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
    

    public function listarReservaciones()
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la gestión de reservaciones.');
        }

        $reservaciones = DB::table('reservaciones')->get();
        return view('admin.reservaciones.index', compact('reservaciones'));
    }

    public function eliminarReservacion($id)
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        DB::table('reservaciones')->where('id', $id)->delete();
        return redirect()->route('admin.reservaciones.index')->with('success', 'Reservación eliminada correctamente.');
    }

    public function generarReporte(Request $request)
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para generar reportes.');
        }

        $tipo = $request->input('tipo');
        $datos = [];

        switch ($tipo) {
            case 'usuarios':
                $datos = DB::table('users')->get();
                break;
            case 'vuelos':
                $datos = DB::table('vuelos')->get();
                break;
            case 'hoteles':
                $datos = DB::table('hoteles')->get();
                break;
            case 'reservaciones':
                $datos = DB::table('reservaciones')->get();
                break;
            default:
                return back()->with('error', 'Tipo de reporte no válido.');
        }

        if ($request->has('exportar_pdf')) {
            $pdf = PDF::loadView('admin.reportes.pdf', compact('datos', 'tipo'));
            return $pdf->download('reporte_' . $tipo . '.pdf');
        }

        if ($request->has('exportar_excel')) {
            return Excel::download(new ReportExport($datos), 'reporte_' . $tipo . '.xlsx');
        }

        return view('admin.reportes.index', compact('datos', 'tipo'));
    }

    public function mostrarRegistro()
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a esta página.');
    }

    return view('admin.registro');
}
public function registrar(RegistroAdministradorRequest $request)
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a esta página.');
    }

  

    DB::table('administradores')->insert([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Administrador registrado correctamente.');
}

//VUELOS

public function editarVueloFormulario($id)
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a esta página.');
    }

    $vuelo = DB::table('vuelos')->where('id', $id)->first();
    if (!$vuelo) {
        return redirect()->route('admin.vuelos.index')->with('error', 'Vuelo no encontrado.');
    }

    return view('admin.vuelos.editar', compact('vuelo'));
}

public function actualizarVuelo(Request $request, $id)
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a esta página.');
    }

    $request->validate([
        'aerolinea' => 'required|string|max:255',
        'numero_vuelo' => 'required|string|max:255',
        'origen' => 'required|string|max:255',
        'destino' => 'required|string|max:255',
        'fecha_salida' => 'required|date',
        'fecha_llegada' => 'required|date|after:fecha_salida',
        'precio' => 'required|numeric|min:0',
        'disponibilidad_asientos' => 'required|integer|min:1',
        'clase' => 'required|in:economica,ejecutiva,primera',
        'escalas' => 'required|boolean',
        'politica_cancelacion' => 'nullable|string',
    ]);

    DB::table('vuelos')->where('id', $id)->update([
        'aerolinea' => $request->aerolinea,
        'numero_vuelo' => $request->numero_vuelo,
        'origen' => $request->origen,
        'destino' => $request->destino,
        'fecha_salida' => $request->fecha_salida,
        'fecha_llegada' => $request->fecha_llegada,
        'precio' => $request->precio,
        'disponibilidad' => $request->disponibilidad_asientos,
        'clase' => $request->clase,
        'escalas' => $request->escalas,
        'politica_cancelacion' => $request->politica_cancelacion,
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.vuelos.index')->with('success', 'Vuelo actualizado correctamente.');
}
public function listarVuelos()
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la gestión de vuelos.');
    }

    $vuelos = DB::table('vuelos')->get();
    return view('admin.vuelos.index', compact('vuelos'));
}

public function crearVueloFormulario()
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la creación de vuelos.');
    }

    return view('admin.vuelos.crear');
}

public function crearVuelo(VueloRequest $request)
{
    
    DB::table('vuelos')->insert([
        'aerolinea' => $request->aerolinea,
        'numero_vuelo' => $request->numero_vuelo,
        'origen' => $request->origen,
        'destino' => $request->destino,
        'fecha_salida' => $request->fecha_salida,
        'fecha_llegada' => $request->fecha_llegada,
        'precio' => $request->precio,
        'disponibilidad' => $request->disponibilidad_asientos, 
        'clase' => $request->clase,
        'escalas' => $request->escalas,
        'politica_cancelacion' => $request->politica_cancelacion,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.vuelos.index')->with('success', 'Vuelo creado correctamente.');
}


public function eliminarVuelo($id)
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
    }

    DB::table('vuelos')->where('id', $id)->delete();
    return redirect()->route('admin.vuelos.index')->with('success', 'Vuelo eliminado correctamente.');
}


//hoteles
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

        $servicios = DB::table('servicios')->get(); 
        return view('admin.hoteles.crear', compact('servicios'));
    }

    public function crearHotel(HotelRequest $request)
    {
        $hotelId = DB::table('hoteles')->insertGetId([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'categoria' => $request->categoria,
            'precio_noche' => $request->precio_noche,
            'disponibilidad' => $request->disponibilidad,
            'descripcion' => $request->descripcion,
            'politicas_cancelacion' => $request->politicas_cancelacion,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->servicios) {
            foreach ($request->servicios as $servicioId) {
                DB::table('hotel_servicio')->insert([
                    'hotel_id' => $hotelId,
                    'servicio_id' => $servicioId,
                ]);
            }
        }

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

}