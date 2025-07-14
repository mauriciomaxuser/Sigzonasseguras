@extends('layout.app')
@section('contenido')

<h1>LISTADO DE ZONAS DE RIESGO </h1>
<a href="{{ route('riesgos.create') }}">Crear Nueva Zona de Riesgo</a>
&nbsp;&nbsp;&nbsp;&nbsp;

<table class="table table-striped table-bordered" style="width:80%; margin:auto;">
    <thead class="table-dark">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Nivel de riesgo</th>
            <th>Documento</th>
            <th>latitud</th>
            <th>longitud</th>
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
            <td>{{ $riesgo->latitud }}</td>             
            <td>{{ $riesgo->longitud }}</td>
            <td>
                <a href="{{ route('riesgos.edit', $riesgo->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('riesgos.destroy', $riesgo->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    
@endsection