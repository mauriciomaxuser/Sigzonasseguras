@extends('layout.app')
@section('contenido')

<h1 class="mb-4 text-success">Puntos De Encuentro</h1>
<a href="{{ route('puntos.create') }}" class="btn btn-primary mb-3">Nuevo Punto</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{{url ('puntos/mapa')}} " class="btn btn-success mb-3">VER PUNTOS DE ENCUENTRO</a>


<table class="table table-striped table-bordered" style="width:80%; margin:auto;">
    <thead class="table-dark">
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
        @foreach($puntos as $puntos)
        <tr>
            <td>{{ $puntos->nombre }}</td>
            <td>{{ $puntos->capacidad }}</td>
            <td>{{ $puntos->responsable}}</td>
            <td>{{ $puntos->latitud }}</td>
            <td>{{ $puntos->longitud }}</td>
            <td>
                <a href="{{ route('puntos.edit', $puntos->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('puntos.destroy', $puntos->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmarEliminacion(event)">Eliminar</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    function confirmarEliminacion(event) {
        event.preventDefault(); // Detiene el submit para mostrar el SweetAlert

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
                event.target.form.submit(); // Envía el formulario si confirma
            }
        });

        return false; // Evita el submit por defecto
    }

</script>

@endsection