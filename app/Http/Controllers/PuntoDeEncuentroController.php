<?php

namespace App\Http\Controllers;

use App\Models\PuntoDeEncuentro;
use Illuminate\Http\Request;

class PuntoDeEncuentroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //consulta de clientes
        $puntos=PuntoDeEncuentro::all();
        //renderizar la vista y pasar datos
        return view('puntos.index', compact('puntos') );
    }
    public function mapa()
    {
        $puntos=PuntoDeEncuentro::all();
        return view('Puntos.mapa',compact('puntos'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Puntos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PuntoDeEncuentro::create([
            'nombre' => $request->nombre,
            'capacidad' => $request->capacidad,
            'responsable' => $request->responsable,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);

        return redirect()->route('puntos.index')->with('message', 'El punto se creo correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(PuntoDeEncuentro $puntoDeEncuentro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $puntos = PuntoDeEncuentro::findOrFail($id);
        return view('puntos.edit',compact('puntos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $puntos = PuntoDeEncuentro::findOrFail($id);
        $puntos->update([
            'nombre'=>$request->nombre,
            'capacidad'=>$request->capacidad,
            'responsable'=>$request->responsable,
            'latitud'=>$request->latitud,
            'longitud'=>$request->longitud
        ]);
        return redirect()->route('puntos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $puntos = PuntoDeEncuentro::findOrFail($id);
        $puntos->delete();
        return redirect()->route('puntos.index')->with('message', 'El punto se eliminó correctamente');

    }
}
