@extends('layout.app')
@section('contenido')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="fas fa-map-marked-alt me-2"></i> Crear Nueva Zona de Riesgo
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('Seguras.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Zona Segura</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" >
                </div>
                <div class="mb-3">
                    <label for="radio" class="form-label">Radio (en metros)</label>
                    <input type="number" class="form-control" id="radio" name="radio" >
                </div>
                <div class="mb-3">
                    <label for="latitud" class="form-label">Latitud</label>
                    <input type="text" class="form-control" id="latitud" name="latitud" >
                </div>
                <div class="mb-3">
                    <label for="longitud" class="form-label">Longitud</label>
                    <input type="text" class="form-control" id="longitud" name="longitud" >
                </div>
                <div class="mb-3">
                    <label for="tipo_seguridad" class="form-label">Tipo de seguridad</label>
                    <input type="text" class="form-control" id="tipo_seguridad" name="tipo_seguridad" >
                </div>
                
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-2"></i> Guardar Zona Segura
                </button>
                <a href="{{ route('seguras.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection