<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
  
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function generarReporte()
    {
        return view('admin.reportes'); 
    }

    public function listarUsuarios()
    {
        return view('admin.usuarios.index');
    }

    public function crearUsuarioFormulario()
    {
  
        return view('admin.usuarios.create');
    }

    public function crearUsuario(Request $request)
    {

    }

    public function eliminarUsuario($id)
    {
    
    }

    public function listarVuelos()
    {
        return view('admin.vuelos.index');
    }

    public function crearVueloFormulario()
    {
        return view('admin.vuelos.create');
    }

    public function crearVuelo(Request $request)
    {
    }

    public function eliminarVuelo($id)
    {
    }

    public function listarHoteles()
    {
        return view('admin.hoteles.index');
    }

    public function crearHotelFormulario()
    {
        return view('admin.hoteles.create');
    }

    public function crearHotel(Request $request)
    {
    }

    public function eliminarHotel($id)
    {
    }

    public function listarReservaciones()
    {
        return view('admin.reservaciones.index');
    }

    public function eliminarReservacion($id)
    {
    }
}
