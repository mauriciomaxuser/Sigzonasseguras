@extends('layout.app')
@section('contenido')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="fas fa-map-marked-alt me-2"></i> Crear Nueva Zona segura
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('seguras.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Zona Segura</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" >
                </div>
                <label for="">Radio</label>
                <input type="number" name="radio" id="radio" class="form-control" placeholder="Porfavor ingrese el radio">

                <label for="">Ubicacion de la alarma</label><br>
                <div class=row>
                    <div class="col-md-6">
                        <label for="">Latitud</label>
                        <input type="text" id="latitud" name="latitud" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="">Longitud</label>
                        <input type="text" id="longitud" name="longitud" class="form-control" readonly>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="tipo_seguridad" class="form-label">Tipo de seguridad</label>
                    <input type="text" class="form-control" id="tipo_seguridad" name="tipo_seguridad" >
                </div>

                <div id="mapa1" style="border:2px solid black; height:300px; width:100%;"></div>


                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGraficoCirculo">
                Graficar
                </button>


                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-2"></i> Guardar Zona Segura
                </button>
                <a href="{{ route('seguras.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Cancelar
                </a>

                <!-- Modal -->
            <div class="modal fade" id="modalGraficoCirculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Rango Sonoro de la Alarma</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div id="mapa-circulo" style="border:2px solid blue; height:300px; width:100%;">

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="graficarCirculo();" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>    
                </div>
                </div>
            </div>
            </div>

            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    var mapa; //variable global
    function initMap() {
        var latitud = -0.9374805;
        var longitud = -78.6161327;

        var latitud_longitud = new google.maps.LatLng(latitud, longitud);
        mapa = new google.maps.Map(document.getElementById('mapa1'), {
            center: latitud_longitud,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marcador = new google.maps.Marker({
            position: latitud_longitud,
            map: mapa,
            title: "Seleccione la dirección",
            draggable: true
        });

        google.maps.event.addListener(marcador, 'dragend', function(event) {
            document.getElementById("latitud").value = this.getPosition().lat();
            document.getElementById("longitud").value = this.getPosition().lng();
        });
    }
    
    //graficar circulo con base al radio y al centro
      function graficarCirculo(){
        var radio=document.getElementById('radio').value;
        var latitud=document.getElementById('latitud').value;
        var longitud=document.getElementById('longitud').value;
        //alert(radio+"\n"+latitud+"\n"+longitud);

        var latitud_longitud= new google.maps.LatLng(-0.9374805,-78.6161327);
        var mapaCirculo=new google.maps.Map(
         document.getElementById('mapa-circulo'),
        {
            center:latitud_longitud,
            zoom:15,
            mapTypeId:google.maps.MapTypeId.SATELITE //ROADMAP
        }
        );

        var centro= new google.maps.LatLng(latitud,longitud);

        
        var marcadorCentroCirculo=new google.maps.Marker({
            position:centro,
            map:mapaCirculo,
            title:"Centro del Circulo",
            draggable:false
        });
        
        var circuloSonoro=new google.maps.Circle({
            strokeColor:"#FF0000",
            strokeOpacity:0.8,
            strokeWeight:2,
            fillColor:"blue",
            fillOpacity:0.5,
            map:mapaCirculo,
            center:centro,
            radius:parseFloat(radio)
        });
    }

    window.onload = function() {
        initMap();
    };
</script>
@endsection