@extends('layout.app')
@section('contenido')

<h1>LISTADO DE ZONAS DE RIESGO </h1>
<a href="{{ route('riesgos.create') }}" class="btn btn-success">
    <i class="fas fa-map-marker-alt me-2"></i> Nueva Zona de Riesgo
</a>

&nbsp;&nbsp;&nbsp;&nbsp;

<table class="table table-striped table-bordered" style="width:80%; margin:auto;">
    <thead class="table-dark">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Nivel de riesgo</th>
            <th>Documento</th>
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
            <td>
                @if($riesgo->documento)
                    <a href="{{ asset('storage/' . $riesgo->documento) }}" target="_blank">Ver Documento</a>
                @else
                    No disponible
                @endif
            </td>
            <td>{{ $riesgo->latitud1 }}</td>             
            <td>{{ $riesgo->longitud1 }}</td>
            <td>{{ $riesgo->latitud2 }}</td>    
            <td>{{ $riesgo->longitud2 }}</td>
            <td>{{ $riesgo->latitud3 }}</td>
            <td>{{ $riesgo->longitud3 }}</td>
            <td>{{ $riesgo->latitud4 }}</td>
            <td>{{ $riesgo->longitud4 }}</td>
            <td>
                <a href="{{ route('riesgos.edit', $riesgo->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action="{{ route('riesgos.destroy', $riesgo->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $riesgo->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" onclick="eliminacion({{ $riesgo->id }})">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
  

<script>
    function eliminacion(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
@endsection