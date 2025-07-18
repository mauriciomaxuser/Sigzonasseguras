@extends('layout.app')

@section('contenido')
<div class="container mt-5">
    <div class="card shadow p-5 text-center bg-light">
        <h1 class="display-4 text-primary mb-4">Bienvenido al Sistema de Gestión de Zonas</h1>
        <p class="lead mb-4">
            Explora los mapas de Zonas de Riesgo, Zonas Seguras y Puntos de Encuentro.
        </p>

        @auth
            @if(auth()->user()->rol !== 'visitante')
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('puntos.mapa') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-map-marker-alt me-2"></i> Mapa Puntos de Encuentro
                    </a>
                    <a href="{{ route('riesgos.mapa') }}" class="btn btn-danger btn-lg">
                        <i class="fas fa-exclamation-triangle me-2"></i> Mapa Zonas de Riesgo
                    </a>
                    <a href="{{ route('seguras.mapa') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shield-alt me-2"></i> Mapa Zonas Seguras
                    </a>
                </div>
                <p class="mt-4">
                    <a href="{{ route('puntos.index') }}" class="btn btn-outline-success me-2">Gestionar Puntos</a>
                    <a href="{{ route('riesgos.index') }}" class="btn btn-outline-danger me-2">Gestionar Riesgos</a>
                    <a href="{{ route('seguras.index') }}" class="btn btn-outline-primary">Gestionar Zonas Seguras</a>
                </p>
            @else
                {{-- Visitante autenticado --}}
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('puntos.mapa') }}" class="btn btn-info btn-lg">
                        <i class="fas fa-map-marker-alt me-2"></i> Mapa Puntos de Encuentro
                    </a>
                    <a href="{{ route('riesgos.mapa') }}" class="btn btn-danger btn-lg">
                        <i class="fas fa-exclamation-triangle me-2"></i> Mapa Zonas de Riesgo
                    </a>
                    <a href="{{ route('seguras.mapa') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shield-alt me-2"></i> Mapa Zonas Seguras
                    </a>
                    <a href="{{ route('global.index') }}" class="btn btn-warning btn-lg">
                        <i class="fas fa-shield-alt me-2"></i> Mapa General
                    </a>
                </div>
                
            @endif
        @else
            {{-- No autenticado --}}
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('puntos.mapa') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-map-marker-alt me-2"></i> Mapa Puntos de Encuentro
                </a>
                <a href="{{ route('riesgos.mapa') }}" class="btn btn-danger btn-lg">
                    <i class="fas fa-exclamation-triangle me-2"></i> Mapa Zonas de Riesgo
                </a>
                <a href="{{ route('seguras.mapa') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shield-alt me-2"></i> Mapa Zonas Seguras
                </a>
            </div>
            <p class="mt-4 text-center">
                <a href="{{ route('login.form') }}" class="btn btn-outline-primary">Iniciar sesión</a> para gestionar zonas.
            </p>
        @endauth
    </div>
</div>
@endsection
