<!-- filepath: resources/views/clientes/create.blade.php -->
@extends('layout.app')
@section('contenido')
<div class="container mt-4">
    <form action="{{ route('puntos.store') }}" method="post" class="card shadow p-4">
        @csrf
        <h1 class="mb-4 text-success text-center">Registrar Nuevo Punto</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label"><b>Nombre</b></label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="capacidad" class="form-label"><b>Capacidad:</b></label>
                <input type="number" name="capacidad" id="capacidad" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="responsable" class="form-label"><b>Responsable:</b></label>
                <input type="text" name="responsable" id="responsable" class="form-control" required>
            </div>
        </div>
        
        <div class="row mb-3">
            
            <div class="col-md-3">
                <label for="latitud" class="form-label"><b>Latitud:</b></label>
                <input type="text" name="latitud" id="latitud" class="form-control" readonly required>
            </div>
            <div class="col-md-3">
                <label for="longitud" class="form-label"><b>Longitud:</b></label>
                <input type="text" name="longitud" id="longitud" class="form-control" readonly required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label"><b>Ubicación en el mapa:</b></label>
            <div id="mapa_cliente" style="border:1px solid #ced4da; height:250px; width:100%; border-radius: 8px;"></div>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success px-4">Guardar</button>
            <a href="{{ route('puntos.index') }}" class="btn btn-secondary px-4">Cancelar</a>
        </div>
    </form>
</div>

<script type="text/javascript">
    function initMap(){
        var latitud_longitud = new google.maps.LatLng(-0.9374805, -78.6161327);
        var mapa = new google.maps.Map(
            document.getElementById('mapa_cliente'),
            {
                center: latitud_longitud,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        );
        var marcador = new google.maps.Marker({
            position: latitud_longitud,
            map: mapa,
            title: "Seleccione la dirección",
            draggable: true
        });
        google.maps.event.addListener(
            marcador,
            'dragend',
            function(event){
                var latitud = this.getPosition().lat();
                var longitud = this.getPosition().lng();
                document.getElementById("latitud").value = latitud;
                document.getElementById("longitud").value = longitud;
            }
        );
    }
</script>
@endsection