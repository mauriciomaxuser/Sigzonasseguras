<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// importando modelo Riesgo
use App\Models\Riesgo;
class RiesgoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //consulta datos de zonariesgo
        $riesgos = Riesgo::all();
        return view('riesgos.index', compact('riesgos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna la vista para crear una nueva zona de riesgo
        return view('riesgos.nuevo');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //para enviar los datos del formulario
        $datos= $request = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'nivel_riesgo' => $request->nivel_riesgo,
            'documento' => $request->documento,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ];
        Riesgo::create($datos);
        
        return redirect()->route('riesgos.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
