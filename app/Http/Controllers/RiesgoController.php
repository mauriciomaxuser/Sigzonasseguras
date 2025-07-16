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
            'latitud1' => $request->latitud1,
            'longitud1' => $request->longitud1,
            'latitud2' => $request->latitud2,
            'longitud2' => $request->longitud2,
            'latitud3' => $request->latitud3,
            'longitud3' => $request->longitud3,
            'latitud4' => $request->latitud4,
            'longitud4' => $request->longitud4,
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
        // Busca el riesgo por su ID
        $riesgo = Riesgo::findOrFail($id);
        return view('riesgos.editar', compact('riesgo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $riesgo = Riesgo::findOrFail($id);

        $riesgo->update($request->all());
        return redirect()->route('riesgos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
        $riesgo = Riesgo::findOrFail($id);
        $riesgo->delete();
        return redirect()->route('riesgos.index');
    }
}
