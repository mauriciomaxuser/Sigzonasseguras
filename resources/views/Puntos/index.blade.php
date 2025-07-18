@extends('layout.app')

@section('contenido')

<h1 class="mb-4 text-success">Puntos De Encuentro</h1>

<a href="{{ route('puntos.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-map-marker-alt me-2"></i> Nuevo Punto de Encuentro
</a>
<a href="{{ url('puntos/mapa') }}" class="btn btn-success mb-3">
    <i class="fas fa-map me-2"></i> Mapa Puntos de Encuentro
</a>

<table id="tablaPuntos" class="table table-striped table-bordered table-hover" style="width:100%;">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Capacidad</th>
            <th>Responsable</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th style="width:160px;">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($puntos as $punto)
        <tr>
            <td>{{ $punto->nombre }}</td>
            <td>{{ $punto->capacidad }}</td>
            <td>{{ $punto->responsable }}</td>
            <td>{{ $punto->latitud }}</td>
            <td>{{ $punto->longitud }}</td>
            <td>
                <a href="{{ route('puntos.edit', $punto->id) }}" class="btn btn-warning btn-sm" title="Editar">
                    <i class="fas fa-edit"></i>
                </a>
                <form id="formEliminarPunto{{ $punto->id }}" action="{{ route('puntos.destroy', $punto->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="eliminarPunto({{ $punto->id }})" class="btn btn-danger btn-sm" title="Eliminar">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('scripts')
<script>
    function eliminarPunto(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formEliminarPunto' + id).submit();
            }
        });
    }

    $(document).ready(function() {
        $('#tablaPuntos').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            }
        });
    });
</script>
@endsection
