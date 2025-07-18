@extends('layout.app')

@section('contenido')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h1 class="mb-4 text-primary text-center">Mapa de Puntos de Encuentro</h1>

        <div id="mapa-puntos" style="border:1px solid #ced4da; height:500px; width:100%; border-radius: 8px;"></div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('puntos.index') }}" class="btn btn-danger px-4">
                <i class="fas fa-arrow-left me-2"></i>
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Google Maps JS API -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwgyPfap_2pZcOlUrNAusGyC-k-Sf-ryM&callback=initMap">
</script>

<script type="text/javascript">
    function initMap() {
        const centro = new google.maps.LatLng(-0.9374805, -78.6161327);

        const mapa = new google.maps.Map(document.getElementById('mapa-puntos'), {
            center: centro,
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        const puntos = [
            @foreach($puntos as $p)
                {
                    nombre: @json($p->nombre),
                    capacidad: @json($p->capacidad),
                    latitud: {{ $p->latitud }},
                    longitud: {{ $p->longitud }}
                },
            @endforeach
        ];

        puntos.forEach(punto => {
            const posicion = new google.maps.LatLng(punto.latitud, punto.longitud);

            const marcador = new google.maps.Marker({
                position: posicion,
                map: mapa,
                icon: {
                    url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    scaledSize: new google.maps.Size(32, 32)
                }
            });

            const info = new google.maps.InfoWindow({
                content: `<strong>${punto.nombre}</strong><br>Capacidad: ${punto.capacidad}`
            });

            marcador.addListener('click', () => {
                info.open(mapa, marcador);
            });
        });
    }
</script>
@endsection
