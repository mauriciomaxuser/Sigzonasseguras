@extends('layout.app')

@section('contenido')
<h1>EDITAR ZONA DE RIESGO SELECCIONADA</h1>
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('riesgos.update', $riesgo->id) }}" id="frmeditar" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $riesgo->nombre }}">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3">{{ $riesgo->descripcion }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="nivel_riesgo" class="form-label">Nivel de Riesgo:</label>
                    <select id="nivel_riesgo" name="nivel_riesgo" class="form-select">
                        <option value="alto" {{ $riesgo->nivel_riesgo == 'alto' ? 'selected' : '' }}>Alto</option>
                        <option value="medio" {{ $riesgo->nivel_riesgo == 'medio' ? 'selected' : '' }}>Medio</option>
                        <option value="bajo" {{ $riesgo->nivel_riesgo == 'bajo' ? 'selected' : '' }}>Bajo</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <label><b>COORDENADA N° 1</b></label> <br>
                        <label><b>Latitud:</b></label><br>
                        <input type="number" name="latitud1" id="latitud1" class="form-control" readonly placeholder="Seleccione ..." value="{{ $riesgo->latitud1 }}"><br>
                        <label><b>Longitud:</b></label><br>
                        <input type="number" name="longitud1" id="longitud1" class="form-control" readonly placeholder="Seleccione ..."  value="{{ $riesgo->longitud1 }}"> 
                    </div>
                    <div class="col-md-7">
                        <div id="mapa1" style="height:180px; width:100%; border:2px solid black;"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label><b>COORDENADA N° 2</b></label> <br>
                        <label><b>Latitud:</b></label><br>
                        <input type="number" name="latitud2" id="latitud2" class="form-control" readonly value="{{ $riesgo->latitud2 }}"><br>
                        <label><b>Longitud:</b></label><br>
                        <input type="number" name="longitud2" id="longitud2" class="form-control" readonly value="{{ $riesgo->longitud2 }}">
                    </div>
                    <div class="col-md-7">
                        <div id="mapa2" style="height:180px; width:100%; border:2px solid black;"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label><b>COORDENADA N° 3</b></label> <br>
                        <label><b>Latitud:</b></label><br>
                        <input type="number" name="latitud3" id="latitud3" class="form-control" readonly value="{{ $riesgo->latitud3 }}"><br>
                        <label><b>Longitud:</b></label><br>
                        <input type="number" name="longitud3" id="longitud3" class="form-control" readonly value="{{ $riesgo->longitud3 }}">
                    </div>
                    <div class="col-md-7">
                        <div id="mapa3" style="height:180px; width:100%; border:2px solid black;"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label><b>COORDENADA N° 4</b></label> <br>
                        <label><b>Latitud:</b></label><br>
                        <input type="number" name="latitud4" id="latitud4" class="form-control" readonly value="{{ $riesgo->latitud4 }}"><br>
                        <label><b>Longitud:</b></label><br>
                        <input type="number" name="longitud4" id="longitud4" class="form-control" readonly value="{{ $riesgo->longitud4 }}">
                    </div>
                    <div class="col-md-7">
                        <div id="mapa4" style="height:180px; width:100%; border:2px solid black;"></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save me-1"></i> Actualizar
                </button>

                <button type="reset" class="btn btn-danger me-2">
                    <i class="fas fa-eraser me-1"></i> Limpiar
                </button>
                <button type="button" class="btn btn-primary me-2" onclick="graficarzonariesgo();">
                    <i class="fas fa-draw-polygon me-1"></i> Graficar Zona de Riesgo
                </button>
                <a href="{{ route('riesgos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <i class="fas fa-map me-2"></i> Mapa de la Zona de Riesgo
    </div>
    <div class="card-body p-0">
        <div id="mapa-poligono" style="height:500px; width:100%; border:2px solid  rgb(5, 141, 62);"></div>
    </div>
</div>

<script>
  $("#frmeditar").validate({
    rules: {
        nombre: {
            required: true,
            minlength: 3
        },
        descripcion: {
            required: true,
            minlength: 10
        },
        nivel_riesgo: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: "Por favor, ingrese el nombre de la zona de riesgo.",
            minlength: "El nombre debe tener al menos 3 caracteres."
        },
        descripcion: {
            required: "Por favor, ingrese una descripción.",
            minlength: "La descripción debe tener al menos 10 caracteres."
        },
        nivel_riesgo: {
            required: "Por favor, seleccione un nivel de riesgo."
        }
    },
    submitHandler: function(form) {
      Swal.fire({
        title: '¿Estás seguro?',
        text: "Se actualizará la zona de riesgo.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    }
  });

</script>

<script type="text/javascript">

var mapaPoligono;//Variable Global

function initMap(){
    var latitud_longitud= new google.maps.LatLng(-0.9374805,-78.6161327);

    //INICIO COORDENADA 1
    var mapa1=new google.maps.Map(
      document.getElementById('mapa1'),
      {
        center:latitud_longitud,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      }
    );
    var marcador1=new google.maps.Marker({
      position:latitud_longitud,
      map:mapa1,
      title:"Seleccione la coordenada 1",
      draggable:true
    });
    google.maps.event.addListener(
      marcador1,
      'dragend',
      function(event){
        var latitud=this.getPosition().lat();
        var longitud=this.getPosition().lng();
        document.getElementById("latitud1").value=latitud;
        document.getElementById("longitud1").value=longitud;
      }
    );
    //FIN COORDENADA 1

    //INICIO COORDENADA 2
    var mapa2=new google.maps.Map(
      document.getElementById('mapa2'),
      {
        center:latitud_longitud,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      }
    );
    var marcador2=new google.maps.Marker({
      position:latitud_longitud,
      map:mapa2,
      title:"Seleccione la coordenada 2",
      draggable:true
    });
    google.maps.event.addListener(
      marcador2,
      'dragend',
      function(event){
        var latitud=this.getPosition().lat();
        var longitud=this.getPosition().lng();
        document.getElementById("latitud2").value=latitud;
        document.getElementById("longitud2").value=longitud;
      }
    );
    //FIN COORDENADA 2

    //INICIO COORDENADA 3
    var mapa3=new google.maps.Map(
      document.getElementById('mapa3'),
      {
        center:latitud_longitud,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      }
    );
    var marcador3=new google.maps.Marker({
      position:latitud_longitud,
      map:mapa3,
      title:"Seleccione la coordenada 3",
      draggable:true
    });
    google.maps.event.addListener(
      marcador3,
      'dragend',
      function(event){
        var latitud=this.getPosition().lat();
        var longitud=this.getPosition().lng();
        document.getElementById("latitud3").value=latitud;
        document.getElementById("longitud3").value=longitud;
      }
    );
    //FIN COORDENADA 3

    //INICIO COORDENADA 4
    var mapa4=new google.maps.Map(
      document.getElementById('mapa4'),
      {
        center:latitud_longitud,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      }
    );
    var marcador4=new google.maps.Marker({
      position:latitud_longitud,
      map:mapa4,
      title:"Seleccione la coordenada 4",
      draggable:true
    });
    google.maps.event.addListener(
      marcador4,
      'dragend',
      function(event){
        var latitud=this.getPosition().lat();
        var longitud=this.getPosition().lng();
        document.getElementById("latitud4").value=latitud;
        document.getElementById("longitud4").value=longitud;
      }
    );
    //FIN COORDENADA 4

    mapaPoligono = new google.maps.Map(
      document.getElementById("mapa-poligono"), {
        zoom: 15,
        center: latitud_longitud,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    });
}

function graficarzonariesgo(){
    var coordenada1=new google.maps.LatLng(
        document.getElementById('latitud1').value,
        document.getElementById('longitud1').value
    );
    var coordenada2=new google.maps.LatLng(
        document.getElementById('latitud2').value,
        document.getElementById('longitud2').value
    );
    var coordenada3=new google.maps.LatLng(
        document.getElementById('latitud3').value,
        document.getElementById('longitud3').value
    );
    var coordenada4=new google.maps.LatLng(
        document.getElementById('latitud4').value,
        document.getElementById('longitud4').value
    );

    var coordenadas = [
        coordenada1,
        coordenada2,
        coordenada3,
        coordenada4
    ];

    var poligono = new google.maps.Polygon({
        paths: coordenadas,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#00FF00",
        fillOpacity: 0.35,
    });

    poligono.setMap(mapaPoligono);
}
</script>
@endsection
