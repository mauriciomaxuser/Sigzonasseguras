@extends('layout.app')
@section('contenido')

<form action="{{ route('riesgos.store') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <h1>Crear Nueva Zona de Riesgo</h1>
    <label for="nombre">Nombre de la Zona de Riesgo:</label>
    <input type="text" id="nombre" name="nombre" >
    <br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" ></textarea>
    <br>

    <label for="nivel_riesgo">Nivel de Riesgo:</label><br>
    <select id="nivel_riesgo" name="nivel_riesgo" >
        <option value="">Seleccione una opción</option>
        <option value="alto">Alto</option>
        <option value="medio">Medio</option>
        <option value="bajo">Bajo</option>
    </select>
    <br>
    
    <label for="documento">Documento (PDF):</label><br>
    <input type="file" id="documento" name="documento" accept=".pdf" >
    <br>

    <label for="latitud"><b>Latitud:</b></label><br>
    <input type="number" name="latitud" id="latitud"
    class="form-control" readonly >
    <br>
    <label for="longitud"><b>Longitud:</b></label><br>
    <input type="number" name="longitud" id="longitud"
    class="form-control" readonly >
    <br>

    
    <button type="submit">Guardar</button>
    <a href="{{ route('riesgos.index') }}">Cancelar</a>
    <br>
</form>

@endsection