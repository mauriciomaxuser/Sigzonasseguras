@extends('layout.app')

@section('contenido')

<h1>LISTADO DE ZONAS SEGURAS</h1>

<a href="{{ route('seguras.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-map-marker-alt me-2"></i> Nueva Zona segura
</a>
<a href="{{ route('riesgos.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-map me-2"></i> Mapa Zonas Seguras
</a>

<table id="tablaSeguras" class="table table-striped table-bordered" style="width: 80%; margin: auto;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Radio</th>
            <th>Latitud</th>
            <th>Longitud</th> 
            <th>TIPO DE SEGURIDAD</th>    
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Seguras as $segura)
        <tr>
            <td>{{ $segura->id }}</td>
            <td>{{ $segura->nombre }}</td>
            <td>{{ $segura->radio }}</td>
            <td>{{ $segura->latitud }}</td>
            <td>{{ $segura->longitud }}</td>             
            <td>{{ $segura->tipo_seguridad }}</td>
            <td>
                <a href="{{ route('seguras.edit', $segura->id) }}" class="btn btn-primary btn-sm" title="Editar">
                    <i class="fas fa-edit"></i>
                </a>

                <form id="formEliminarSegura{{ $segura->id }}" action="{{ route('seguras.destroy', $segura->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button onclick="eliminarSegura({{ $segura->id }})" class="btn btn-danger btn-sm" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('scripts')
<script>
    function eliminarSegura(id) {
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
                document.getElementById('formEliminarSegura' + id).submit();
            }
        });
    }

    $(document).ready(function() {
        $('#tablaSeguras').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        }
        });
    });
</script>
@endsection
