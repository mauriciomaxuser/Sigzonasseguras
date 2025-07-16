@extends('layout.app')
@section('contenido')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="fas fa-map-marked-alt me-2"></i> Crear Nueva Zona de Riesgo
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('riesgos.store') }}" id="frmnuevo" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Zona de Riesgo:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" >
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3" ></textarea>
                </div>

                <div class="mb-3">
                    <label for="nivel_riesgo" class="form-label">Nivel de Riesgo:</label>
                    <select id="nivel_riesgo" name="nivel_riesgo" class="form-select" >
                        <option value="">Seleccione una opción</option>
                        <option value="alto">Alto</option>
                        <option value="medio">Medio</option>
                        <option value="bajo">Bajo</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="documento" class="form-label">Documento (PDF):</label>
                    <input type="file" id="documento" name="documento" accept=".pdf" class="form-control">
                </div>

                @for($i = 1; $i <= 4; $i++)
                <div class="row mb-4">
                    <div class="col-md-5">
                        <h5><b>COORDENADA N° {{ $i }}</b></h5>
                        <label for="latitud{{ $i }}" class="form-label">Latitud:</label>
                        <input type="number" name="latitud{{ $i }}" id="latitud{{ $i }}" class="form-control" readonly placeholder="Seleccione...">
                        
                        <label for="longitud{{ $i }}" class="form-label mt-2">Longitud:</label>
                        <input type="number" name="longitud{{ $i }}" id="longitud{{ $i }}" class="form-control" readonly placeholder="Seleccione...">
                    </div>
                    <div class="col-md-7">
                        <div id="mapa{{ $i }}" style="height:180px; width:100%; border:2px solid #343a40; border-radius:6px;"></div>
                    </div>
                </div>
                @endfor

                <div class="text-center">
                    <button type="button" class="btn btn-success me-2" onclick="confirmarEnvio();">
                        <i class="fas fa-save me-1"></i> Guardar
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
                </div>
            </form>
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
</div>
<script>
  $("#frmnuevo").validate({
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
        },
        documento: {
            required: true,
            extension: "pdf"
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
        },
        documento: {
            required: "Por favor, cargue un documento en formato PDF.",
            extension: "El archivo debe ser un PDF."
        }
    }
  });
            
</script>
<script>
    $("#documento").fileinput({
            language: "es",
            allowedFileExtensions: ["pdf"],
            showCaption: false,
            dropZoneEnabled: true,
            showClose: false
    });

</script>

<script>
    function confirmarEnvio() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se guardará la nueva zona de riesgo.",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('form').submit();
            }
        });
    }
</script>



<script type="text/javascript">

     var mapaPoligono;//Variable Global

      function initMap(){
       // alert("mapa ok");
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
          title:"Seleccione la coordenada 3",
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
        //Dibujando el mapa del poligono
        mapaPoligono = new google.maps.Map(
               document.getElementById("mapa-poligono"), {
          zoom: 15,
          center: latitud_longitud, 
          mapTypeId:google.maps.MapTypeId.ROADMAP
        });

      }

      function graficarzonariesgo(){
            //alert("Graficando");

            //Capturando coordenadas seleccionas en el mapa
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
            //Arreglo con las 4 coordenadas
            var coordenadas = [
                coordenada1,
                coordenada2,
                coordenada3,
                coordenada4
            ];

            // Crear el polígono
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