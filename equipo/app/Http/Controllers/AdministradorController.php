<?php

namespace App\Http\Controllers;

use App\Http\Requests\VueloRequest;
use App\Http\Requests\HotelRequest;
use App\Http\Requests\RegistroAdministradorRequest;
use App\Http\Requests\RegistroUsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PDF;
use Excel;
use App\Exports\ReportExport;

class AdministradorController extends Controller
{
    // AUTENTICACION ADMINISTRADOR
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

     // Verificación de autenticación (usada para cada una de las funciones del administrador)
     private function verificarAutenticacion()
     {
         if (!Session::has('admin_autenticado')) {
             abort(403, 'No autorizado.');
         }
     }

    //LOGOUT ADMINISTRADOR
    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Sesión cerrada correctamente.');
    }

    public function dashboard()
    {
        $this->verificarAutenticacion();
        return view('admin.dashboard');
    }

    // GESTION DE USUARIOS
    public function listarUsuarios()
    {
        $this->verificarAutenticacion();
        $usuarios = DB::table('users')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }
    public function mostrarRegistro()
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a esta página.');
        }
    
        return view('admin.registro');
    }
    
    public function crearUsuarioFormulario()
    {
        if (!Session::has('admin_autenticado')) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a la creación de usuarios.');
        }
    
        return view('admin.usuarios.crear');
    }
    

    public function crearUsuario(RegistroUsuarioRequest $request)
    {
        $this->verificarAutenticacion();
    
        try {
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
        } catch (\Exception $e) {
            \Log::error('Error al crear el usuario: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al crear el usuario. Por favor, inténtelo de nuevo.');
        }
    }
    
   
public function eliminarUsuario($id)
{
    $this->verificarAutenticacion();
    DB::table('users')->where('id', $id)->delete();
    return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
}



//GESTION ADMINISTRADORES
public function listarAdministradores()
{
    $this->verificarAutenticacion();

    $administradores = DB::table('administradores')->get();

    return view('admin.administradores.index', compact('administradores'));
}

public function eliminarAdministrador($id)
{
    $this->verificarAutenticacion();

    DB::table('administradores')->where('id', $id)->delete();

    return redirect()->route('admin.administradores.index')->with('success', 'Administrador eliminado correctamente.');
}


public function registrar(RegistroAdministradorRequest $request)
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a esta página.');
    }

    try {
        DB::table('administradores')->insert([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Administrador registrado correctamente.');
    } catch (\Exception $e) {
        \Log::error('Error al registrar administrador: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Hubo un problema al registrar el administrador. Por favor, inténtelo de nuevo.');
    }
}

 
    // GESTION DE VUELOS
    public function listarVuelos()
    {
        $this->verificarAutenticacion();
        $vuelos = DB::table('vuelos')->get();
        return view('admin.vuelos.index', compact('vuelos'));
    }

    public function crearVueloFormulario()
    {
        $this->verificarAutenticacion();
        return view('admin.vuelos.crear');
    }

    public function crearVuelo(VueloRequest $request)
    {
        $this->verificarAutenticacion();
        DB::table('vuelos')->insert($request->validated() + [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.vuelos.index')->with('success', 'Vuelo creado correctamente.');
    }

    public function editarVueloFormulario($id)
    {
        $this->verificarAutenticacion();
        $vuelo = DB::table('vuelos')->find($id);

        if (!$vuelo) {
            return redirect()->route('admin.vuelos.index')->with('error', 'Vuelo no encontrado.');
        }

        return view('admin.vuelos.editar', compact('vuelo'));
    }

    public function actualizarVuelo(VueloRequest $request, $id)
    {
        $this->verificarAutenticacion();
    
        try {
            DB::table('vuelos')->where('id', $id)->update($request->validated() + ['updated_at' => now()]);
    
            return redirect()->route('admin.vuelos.index')->with('success', 'Vuelo actualizado correctamente.');
        } catch (\Exception $e) {
            \Log::error('Error al actualizar el vuelo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el vuelo. Por favor, inténtelo de nuevo.');
        }
    }
    

    public function eliminarVuelo($id)
    {
        $this->verificarAutenticacion();
        DB::table('vuelos')->where('id', $id)->delete();
        return redirect()->route('admin.vuelos.index')->with('success', 'Vuelo eliminado correctamente.');
    }



    // GESTION DE HOTELES NO MODIFICAR
    public function listarHoteles()
    {
        $this->verificarAutenticacion();
        $hoteles = DB::table('hoteles')->get();
        return view('admin.hoteles.index', compact('hoteles'));
    }
public function crearHotelFormulario()
{
    $this->verificarAutenticacion(); 

    $servicios = DB::table('servicios')->get(); 

    return view('admin.hoteles.crear', compact('servicios')); 
}

public function crearHotel(HotelRequest $request)
{
    $this->verificarAutenticacion(); 

    try {
        $fotografiaPath = null;
        if ($request->hasFile('fotografia') && $request->file('fotografia')->isValid()) {
            $file = $request->file('fotografia');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $fotografiaPath = 'images/' . $filename;
        }

        $hotelId = DB::table('hoteles')->insertGetId([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'categoria' => $request->categoria,
            'precio_noche' => $request->precio_noche,
            'disponibilidad' => $request->disponibilidad,
            'descripcion' => $request->descripcion,
            'politicas_cancelacion' => $request->politicas_cancelacion,
            'fotografia' => $fotografiaPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->has('servicios') && is_array($request->servicios)) {
            $servicios = array_map(function ($servicioId) use ($hotelId) {
                return [
                    'hotel_id' => $hotelId,
                    'servicio_id' => $servicioId,
                ];
            }, $request->servicios);

            DB::table('hotel_servicio')->insert($servicios);
        }

        if ($request->ajax()) {
            return response()->json(['success' => 'Hotel creado correctamente.']);
        }

        return redirect()->route('admin.hoteles.index')->with('success', 'Hotel creado correctamente.');
    } catch (\Exception $e) {
        \Log::error('Error al crear el hotel: ' . $e->getMessage());

        if ($request->ajax()) {
            return response()->json(['error' => 'Hubo un problema al crear el hotel. Por favor, inténtelo de nuevo.']);
        }

        return redirect()->back()->with('error', 'Hubo un problema al crear el hotel. Por favor, inténtelo de nuevo.');
    }
}
public function actualizarHotel(HotelRequest $request, $id)
{
    $this->verificarAutenticacion();

    try {
        $hotel = DB::table('hoteles')->where('id', $id)->first();
        
        // Actualizar los datos del hotel
        DB::table('hoteles')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'categoria' => $request->categoria,
            'precio_noche' => $request->precio_noche,
            'disponibilidad' => $request->disponibilidad,
            'descripcion' => $request->descripcion,
            'politicas_cancelacion' => $request->politicas_cancelacion,
            'updated_at' => now(),
        ]);

        if ($request->hasFile('fotografia') && $request->file('fotografia')->isValid()) {
            if ($hotel->fotografia && file_exists(public_path($hotel->fotografia))) {
                unlink(public_path($hotel->fotografia));
            }

            $file = $request->file('fotografia');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $fotografiaPath = 'images/' . $filename;

            DB::table('hoteles')->where('id', $id)->update(['fotografia' => $fotografiaPath]);
        }

        DB::table('hotel_servicio')->where('hotel_id', $id)->delete();
        if ($request->has('servicios') && is_array($request->servicios)) {
            $servicios = array_map(function ($servicioId) use ($id) {
                return [
                    'hotel_id' => $id,
                    'servicio_id' => $servicioId,
                ];
            }, $request->servicios);

            DB::table('hotel_servicio')->insert($servicios);
        }

        return redirect()->route('admin.hoteles.index')->with('success', 'Hotel actualizado correctamente.');
    } catch (\Exception $e) {
        \Log::error('Error al actualizar el hotel: ' . $e->getMessage());
        return redirect()->route('admin.hoteles.index')->with('error', 'Hubo un problema al actualizar el hotel. Por favor, inténtelo de nuevo.');
    }
}


public function editarHotelFormulario($id)
{
    $this->verificarAutenticacion(); 
    $hotel = DB::table('hoteles')->where('id', $id)->first();
    if (!$hotel) {
        return redirect()->route('admin.hoteles.index')->with('error', 'Hotel no encontrado.');
    }

    $servicios = DB::table('servicios')->get();
    $hotelServicios = DB::table('hotel_servicio')->where('hotel_id', $id)->pluck('servicio_id')->toArray();

    return view('admin.hoteles.editar', compact('hotel', 'servicios', 'hotelServicios'));
}

//VER DETALLES HOTEL NO MODIFICAR
public function verDetallesHotel($id)
{
    if (!Session::has('admin_autenticado')) {
        return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder a esta página.');
    }
    $hotel = DB::table('hoteles')->where('id', $id)->first();
    if (!$hotel) {
        return redirect()->route('admin.hoteles.index')->with('error', 'Hotel no encontrado.');
    }
    $servicios = DB::table('hotel_servicio')
        ->join('servicios', 'hotel_servicio.servicio_id', '=', 'servicios.id')
        ->where('hotel_servicio.hotel_id', $id)
        ->select('servicios.nombre')
        ->get();
    return view('admin.hoteles.detalles', compact('hotel', 'servicios'));
}

//ELIMINAR HOTEL NO MODIFICAR
public function destroy($id)
{
    $this->verificarAutenticacion(); 
    try {      
        $hotel = DB::table('hoteles')->where('id', $id)->first();
        if (!$hotel) {
            return redirect()->route('admin.hoteles.index')->with('error', 'Hotel no encontrado.');
        }     
        if ($hotel->fotografia && file_exists(public_path('images/' . $hotel->fotografia))) {
            unlink(public_path('images/' . $hotel->fotografia));
        }
        DB::table('hoteles')->where('id', $id)->delete();    
        DB::table('hotel_servicio')->where('hotel_id', $id)->delete();

        return redirect()->route('admin.hoteles.index')->with('success', 'Hotel eliminado correctamente.');
    } catch (\Exception $e) {
        \Log::error('Error al eliminar el hotel: ' . $e->getMessage());
        return redirect()->route('admin.hoteles.index')->with('error', 'Hubo un problema al eliminar el hotel.');
    }
}







    // Generar Reportes
    public function generarReporte(Request $request)
    {
        $this->verificarAutenticacion();

        $tipo = $request->input('tipo');
        $tablas = [
            'usuarios' => 'users',
            'vuelos' => 'vuelos',
            'hoteles' => 'hoteles',
            'reservaciones' => 'reservaciones',
        ];

        if (!array_key_exists($tipo, $tablas)) {
            return back()->with('error', 'Tipo de reporte no válido.');
        }

        $datos = DB::table($tablas[$tipo])->get();

        if ($request->has('exportar_pdf')) {
            $pdf = PDF::loadView('admin.reportes.pdf', compact('datos', 'tipo'));
            return $pdf->download("reporte_{$tipo}.pdf");
        }

        if ($request->has('exportar_excel')) {
            return Excel::download(new ReportExport($datos), "reporte_{$tipo}.xlsx");
        }

        return view('admin.reportes.index', compact('datos', 'tipo'));
    }

   
}
