@extends('layout.app')

@section('contenido')
<h1>MAPA DE ZONAS SEGURAS</h1><br>

<div class="mb-3">
    <label for="filtroTipo" class="form-label"><strong>Filtrar por Tipo de Seguridad:</strong></label>
    <select id="filtroTipo" class="form-select" style="max-width: 300px;">
        <option value="todos" selected>Todos</option>
        <option value="alto">Alta</option>
        <option value="medio">Media</option>
        <option value="bajo">Baja</option>
    </select>
</div>

<div id="mapa-seguras" style="height: 500px; width: 100%; border: 2px solid black;"></div>

<a href="{{ route('seguras.index') }}" class="btn btn-secondary mt-3">
    <i class="fas fa-arrow-left me-2"></i> Volver al Listado de Zonas Seguras
</a>
@endsection

@section('scripts')
<!-- Google Maps JS API -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwgyPfap_2pZcOlUrNAusGyC-k-Sf-ryM&callback=initMap&libraries=places">
</script>

<script>
let mapa;
let bounds;
let circulos = [];
const zonasSeguras = [
    @foreach($seguras as $zona)
    {
        id: {{ $zona->id }},
        nombre: @json($zona->nombre),
        radio: {{ $zona->radio }},
        latitud: {{ $zona->latitud }},
        longitud: {{ $zona->longitud }},
        tipo_seguridad: @json(strtolower($zona->tipo_seguridad))
    },
    @endforeach
];

function mostrarCirculos(filtro) {
    // Eliminar círculos previos
    circulos.forEach(c => c.setMap(null));
    circulos = [];
    bounds = new google.maps.LatLngBounds();

    zonasSeguras.forEach(zona => {
        if (filtro === 'todos' || zona.tipo_seguridad === filtro) {
            const centro = new google.maps.LatLng(zona.latitud, zona.longitud);
            bounds.extend(centro);

            let color = '#3498db'; // azul por defecto
            switch (zona.tipo_seguridad) {
                case 'alta': color = '#27ae60'; break;  
                case 'media': color = '#f39c12'; break;  
                case 'baja': color = '#c0392b'; break;   
            }

            const circulo = new google.maps.Circle({
                strokeColor: color,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: color,
                fillOpacity: 0.35,
                map: mapa,
                center: centro,
                radius: zona.radio
            });

            const info = `<div style="font-size:14px;">
                <strong>${zona.nombre}</strong><br>
                Tipo de seguridad: <strong>${zona.tipo_seguridad.charAt(0).toUpperCase() + zona.tipo_seguridad.slice(1)}</strong><br>
                Radio: ${zona.radio} metros
            </div>`;

            const infoWindow = new google.maps.InfoWindow({ content: info });

            circulo.addListener('click', (event) => {
                infoWindow.setPosition(event.latLng);
                infoWindow.open(mapa);
            });

            circulos.push(circulo);
        }
    });

    if (!bounds.isEmpty()) {
        mapa.fitBounds(bounds);
    }
}

function initMap() {
    const centro = new google.maps.LatLng(-1.396900, -78.424400);
    mapa = new google.maps.Map(document.getElementById('mapa-seguras'), {
        center: centro,
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    bounds = new google.maps.LatLngBounds();

    mostrarCirculos('todos');

    document.getElementById('filtroTipo').addEventListener('change', function () {
        mostrarCirculos(this.value);
    });
}
</script>
@endsection
