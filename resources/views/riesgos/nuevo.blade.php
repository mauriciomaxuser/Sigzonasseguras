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

    <div class="row">
                <div class="col-md-5">
                    <label for=""><b>COORDENADA N° 1</b></label> <br>
                    <label for=""><b>Latitud:</b></label><br>
                    <input type="number" name="latitud1" id="latitud1"
                    class="form-control" readonly placeholder="Seleccione ..."><br>
                    <label for=""><b>Longitud:</b></label><br>
                    <input type="number" name="longitud1" id="longitud1"
                    class="form-control" readonly placeholder="Seleccione ...">
                </div>
                <div class="col-md-7">
                    <div id="mapa1" style="height:180px; 
                    width:100%; border:2px solid black;"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <label for=""><b>COORDENADA N° 2</b></label> <br>
                    <label for=""><b>Latitud:</b></label><br>
                    <input type="number" name="latitud2" id="latitud2"
                    class="form-control" readonly placeholder="Seleccione ..."><br>
                    <label for=""><b>Longitud:</b></label><br>
                    <input type="number" name="longitud2" id="longitud2"
                    class="form-control" readonly placeholder="Seleccione ...">
                </div>
                <div class="col-md-7">
                    <div id="mapa2" style="height:180px; 
                    width:100%; border:2px solid black;"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <label for=""><b>COORDENADA N° 3</b></label> <br>
                    <label for=""><b>Latitud:</b></label><br>
                    <input type="number" name="latitud3" id="latitud3"
                    class="form-control" readonly placeholder="Seleccione ..."><br>
                    <label for=""><b>Longitud:</b></label><br>
                    <input type="number" name="longitud3" id="longitud3"
                    class="form-control" readonly placeholder="Seleccione ...">
                </div>
                <div class="col-md-7">
                    <div id="mapa3" style="height:180px; 
                    width:100%; border:2px solid black;"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <label for=""><b>COORDENADA N° 4</b></label> <br>
                    <label for=""><b>Latitud:</b></label><br>
                    <input type="number" name="latitud4" id="latitud4"
                    class="form-control" readonly placeholder="Seleccione ..."><br>
                    <label for=""><b>Longitud:</b></label><br>
                    <input type="number" name="longitud4" id="longitud4"
                    class="form-control" readonly placeholder="Seleccione ...">
                </div>
                <div class="col-md-7">
                    <div id="mapa4" style="height:180px; 
                    width:100%; border:2px solid black;"></div>
                </div>
            </div>
    
    <button type="submit">Guardar</button>
    <a href="{{ route('riesgos.index') }}">Cancelar</a>
    <br>
</form>

@endsection