<?php

namespace App\Http\Controllers;
use App\Models\PuntoDeEncuentro;
use App\Models\Riesgo;
use App\Models\Segura;

use Illuminate\Http\Request;

class GlobalController extends Controller
{
    //
    public function index()
    {
        $puntos = PuntoDeEncuentro::all();
        $riesgos = Riesgo::all();
        $seguras = Segura::all();

        return view('global.index', compact('puntos', 'riesgos', 'seguras'));
    }
}
