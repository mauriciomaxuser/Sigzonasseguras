@extends('layout.app')

@section('contenido')
<h1>LISTADO DE ZONAS DE RIESGO</h1>

<a href="{{ route('riesgos.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-map-marker-alt me-2"></i> Nueva Zona de Riesgo
</a>

<table id="tablaRiesgos" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Nivel de riesgo</th>
            <th>Latitud 1</th>
            <th>Longitud 1</th>
            <th>Latitud 2</th>
            <th>Longitud 2</th>
            <th>Latitud 3</th>
            <th>Longitud 3</th>
            <th>Latitud 4</th>
            <th>Longitud 4</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($riesgos as $riesgo)
        <tr>
            <td>{{ $riesgo->id }}</td>
            <td>{{ $riesgo->nombre }}</td>
            <td>{{ $riesgo->descripcion }}</td>
            <td>{{ $riesgo->nivel_riesgo }}</td>
            <td>{{ $riesgo->latitud1 }}</td>
            <td>{{ $riesgo->longitud1 }}</td>
            <td>{{ $riesgo->latitud2 }}</td>
            <td>{{ $riesgo->longitud2 }}</td>
            <td>{{ $riesgo->latitud3 }}</td>
            <td>{{ $riesgo->longitud3 }}</td>
            <td>{{ $riesgo->latitud4 }}</td>
            <td>{{ $riesgo->longitud4 }}</td>
            <td>
                <a href="{{ route('riesgos.edit', $riesgo->id) }}" class="btn btn-primary btn-sm" title="Editar">
                    <i class="fas fa-edit"></i>
                </a>
                <button onclick="eliminarRiesgo({{ $riesgo->id }})" class="btn btn-danger btn-sm" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <form id="formEliminarRiesgo{{ $riesgo->id }}"
                      action="{{ route('riesgos.destroy', $riesgo->id) }}"
                      method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    function eliminarRiesgo(id) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡Esta acción no se puede deshacer!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEliminarRiesgo' + id).submit();
            }
        });
    }

    $(document).ready(function() {
        $('#tablaRiesgos').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
            },
        });
    });
</script>
@endsection
