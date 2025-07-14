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
    
    
    <center>
        <button type="submit" class="btn btn-success">Guardar</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="reset" class="btn btn-danger">Limpiar</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-primary" onclick="graficarzonariesgo();">Graficar circuito</button>
        <a href="{{ route('riesgos.index') }}" class = "btn btn-secondary">Cancelar</a>
    </center>    
</form>
<br>
<div class="row">
    <div class="col-md-12">
        <div id="mapa-poligono" 
         style="height:500px; width:100%;
          border:2px solid blue;">

        </div>
    </div>
</div>

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