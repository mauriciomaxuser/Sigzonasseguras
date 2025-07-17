@extends('layout.app')
@section('contenido')

<h1>LISTADO DE ZONAS SEGURAS </h1>
<a href="{{route ('Seguras.create')}}" class="btn btn-success">
    <i class="fas fa-map-marker-alt me-2"></i> Nueva Zona segura
</a>

&nbsp;&nbsp;&nbsp;&nbsp;

<table class="table table-striped table-bordered" style="width:80%; margin:auto;">
    <thead class="table-dark">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Radio</th>
            <th>Latitud </th>
            <th>Longitud </th> 
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
                <a href=" " class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action=" " method="POST" style="display:inline;" id="delete-form-{{ $riesgo->id }}">
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