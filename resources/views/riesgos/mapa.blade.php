@extends('layout.app')

@section('contenido')
<h1>MAPA DE ZONAS DE RIESGO</h1><br>

<div class="mb-3">
    <label for="filtroNivel" class="form-label"><strong>Filtrar por Nivel de Riesgo:</strong></label>
    <select id="filtroNivel" class="form-select" style="max-width: 300px;">
        <option value="todos" selected>Todos</option>
        <option value="alto">Alto</option>
        <option value="medio">Medio</option>
        <option value="bajo">Bajo</option>
    </select>
</div>

<div id="mapa-zonas" style="height: 500px; width: 100%; border: 2px solid black;"></div>

<a href="{{ route('riesgos.index') }}" class="btn btn-secondary mt-3">
    <i class="fas fa-arrow-left me-2"></i> REGRESAR
</a>
@endsection

@section('scripts')
<!-- Google Maps JS API -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwgyPfap_2pZcOlUrNAusGyC-k-Sf-ryM&callback=initMap&libraries=places">
</script>

<script type="text/javascript">
    let mapa;
    let bounds;
    let poligonos = [];

    function initMap() {
        var centro = new google.maps.LatLng(-1.396900, -78.424400);
        mapa = new google.maps.Map(document.getElementById('mapa-zonas'), {
            center: centro,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        bounds = new google.maps.LatLngBounds();

        // Array con las zonas desde PHP a JS
        const zonas = [
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

        function mostrarPoligonos(filtro) {
            poligonos.forEach(p => p.setMap(null));
            poligonos = [];
            bounds = new google.maps.LatLngBounds();

            zonas.forEach(zona => {
                if (filtro === 'todos' || zona.nivel_riesgo === filtro) {
                    zona.coordenadas.forEach(coord => {
                        bounds.extend(new google.maps.LatLng(coord.lat, coord.lng));
                    });

                    let color = '#3498db'; 
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

        mostrarPoligonos('todos');

        document.getElementById('filtroNivel').addEventListener('change', function() {
            mostrarPoligonos(this.value);
        });
    }
</script>
@endsection
