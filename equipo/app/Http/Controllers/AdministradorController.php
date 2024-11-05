<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    
    public function generarReporte()
    {
        return view('admin.reportes'); 
    }
}
