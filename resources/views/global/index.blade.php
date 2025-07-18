@extends('layout.app')

@section('contenido')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h1 class="mb-4 text-primary text-center">Mapa General</h1>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="filtroNivel" class="form-label"><strong>Filtrar Nivel de Riesgo:</strong></label>
                <select id="filtroNivel" class="form-select">
                    <option value="todos" selected>Todos</option>
                    <option value="alto">Alto</option>
                    <option value="medio">Medio</option>
                    <option value="bajo">Bajo</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="filtroTipo" class="form-label"><strong>Filtrar Tipo de Seguridad:</strong></label>
                <select id="filtroTipo" class="form-select">
                    <option value="todos" selected>Todos</option>
                    <option value="alta">Alta</option>
                    <option value="media">Media</option>
                    <option value="baja">Baja</option>
                </select>
            </div>
        </div>

        <div id="mapa-combinado" style="height: 600px; width: 100%; border: 2px solid black; border-radius: 8px;"></div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('riesgos.index') }}" class="btn btn-danger px-4 me-2">
                <i class="fas fa-arrow-left me-2"></i> REGRESAR
            </a>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwgyPfap_2pZcOlUrNAusGyC-k-Sf-ryM&callback=initMap">
</script>

<script>
let mapa;
let bounds;

let marcadores = [];
let poligonos = [];
let circulos = [];

// Datos desde Laravel a JS
const puntosEncuentro = [
    @foreach($puntos as $p)
    {
        nombre: @json($p->nombre),
        capacidad: @json($p->capacidad),
        latitud: {{ $p->latitud }},
        longitud: {{ $p->longitud }}
    },
    @endforeach
];

const zonasRiesgo = [
    @foreach($riesgos as $zona)
    {
        nombre: @json($zona->nombre),
        descripcion: @json($zona->descripcion),
        nivel_riesgo: @json(strtolower($zona->nivel_riesgo)),
        coordenadas: [
            { lat: {{ $zona->latitud1 }}, lng: {{ $zona->longitud1 }} },
            { lat: {{ $zona->latitud2 }}, lng: {{ $zona->longitud2 }} },
            { lat: {{ $zona->latitud3 }}, lng: {{ $zona->longitud3 }} },
            { lat: {{ $zona->latitud4 }}, lng: {{ $zona->longitud4 }} }
        ]
    },
    @endforeach
];

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

function initMap() {
    const centro = new google.maps.LatLng(-1.0, -78.5); // Ajusta el centro si quieres
    mapa = new google.maps.Map(document.getElementById('mapa-combinado'), {
        center: centro,
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    bounds = new google.maps.LatLngBounds();

    // Mostrar todos al cargar
    mostrarMarcadores();
    mostrarPoligonos('todos');
    mostrarCirculos('todos');

    // Filtros
    document.getElementById('filtroNivel').addEventListener('change', function() {
        mostrarPoligonos(this.value);
    });

    document.getElementById('filtroTipo').addEventListener('change', function() {
        mostrarCirculos(this.value);
    });
}

function mostrarMarcadores() {
    // Limpiar marcadores anteriores
    marcadores.forEach(m => m.setMap(null));
    marcadores = [];

    puntosEncuentro.forEach(punto => {
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

        marcadores.push(marcador);
        bounds.extend(posicion);
    });

    // Ajustar vista si es que no se cambia por filtros
    if (!bounds.isEmpty()) {
        mapa.fitBounds(bounds);
    }
}

function mostrarPoligonos(filtro) {
    // Eliminar polígonos anteriores
    poligonos.forEach(p => p.setMap(null));
    poligonos = [];

    zonasRiesgo.forEach(zona => {
        if (filtro === 'todos' || zona.nivel_riesgo === filtro) {
            zona.coordenadas.forEach(coord => {
                bounds.extend(new google.maps.LatLng(coord.lat, coord.lng));
            });

            let color = '#3498db'; // azul default
            switch (zona.nivel_riesgo) {
                case 'alto': color = '#e74c3c'; break;
                case 'medio': color = '#f39c12'; break;
                case 'bajo': color = '#2ecc71'; break;
            }

            const poligono = new google.maps.Polygon({
                paths: zona.coordenadas,
                strokeColor: color,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: color,
                fillOpacity: 0.35,
                map: mapa
            });

            const info = `<div style="font-size:14px;">
                <strong>${zona.nombre}</strong><br>
                ${zona.descripcion}<br>
                Nivel de riesgo: <strong>${zona.nivel_riesgo.charAt(0).toUpperCase() + zona.nivel_riesgo.slice(1)}</strong>
            </div>`;

            const infoWindow = new google.maps.InfoWindow({ content: info });

            poligono.addListener('click', function(event) {
                infoWindow.setPosition(event.latLng);
                infoWindow.open(mapa);
            });

            poligonos.push(poligono);
        }
    });

    if (!bounds.isEmpty()) {
        mapa.fitBounds(bounds);
    }
}

function mostrarCirculos(filtro) {
    circulos.forEach(c => c.setMap(null));
    circulos = [];

    zonasSeguras.forEach(zona => {
        if (filtro === 'todos' || zona.tipo_seguridad === filtro) {
            const centro = new google.maps.LatLng(zona.latitud, zona.longitud);
            bounds.extend(centro);

            let color = '#3498db';
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
</script>
@endsection
