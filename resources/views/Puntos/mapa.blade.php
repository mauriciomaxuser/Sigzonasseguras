@extends('layout.app')
@section('contenido')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h1 class="mb-4 text-primary text-center">Ver Mapa de Puntos Seguros</h1>
        <div id="mapa-clientes" style="border:1px solid #ced4da; height:500px; width:100%; border-radius: 8px;"></div>
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('puntos.index') }}" class="btn btn-danger px-4">REGRESAR</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    function initMap() {
        alert("mapa ok");
        var latitud_longitud = new google.maps.LatLng(-0.9374805, -78.6161327);
        var mapa = new google.maps.Map(
            document.getElementById('mapa-clientes'),
            {
                center: latitud_longitud,
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        );

        @foreach($puntos as $punto)
            var coordenadaCliente = new google.maps.LatLng({{ $punto->latitud }}, {{ $punto->longitud }});

            var marcador = new google.maps.Marker({
                position: coordenadaCliente,
                map: mapa,
                icon: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    scaledSize: new google.maps.Size(32, 32)
                },
                draggable: false
            });

            var info = new google.maps.InfoWindow({
                content: `<strong>{{ $punto->nombre }}</strong><br>Capacidad: {{ $punto->capacidad }}`
            });

            // Abrir automáticamente el InfoWindow
            info.open(mapa, marcador);
        @endforeach
    }
</script>
@endsection
