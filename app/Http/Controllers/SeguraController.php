<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Segura;
class SeguraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Seguras = Segura::all();
        return view('Seguras.index', compact('Seguras'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Seguras.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //para almacenar los datos de la zona segura
        $datos = [
            'nombre' => $request-> nombre,
            'radio' => $request-> radio,
            'latitud' => $request-> latitud,
            'longitud' => $request-> longitud,
            'tipo_seguridad' => $request-> tipo_seguridad
        ];
        Segura::create($datos); 
        return redirect()->route('seguras.index');
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
        

    $segura = Segura::findOrFail($id); 
    return view('Seguras.editar', compact('segura')); 

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    
        $segura = Segura::findOrFail($id); 
        $segura->update($request->all()); 
        return redirect()->route('seguras.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      
        $segura = Segura::findOrFail($id);
        $segura->delete(); 
        return redirect()->route('seguras.index');
    }
}
