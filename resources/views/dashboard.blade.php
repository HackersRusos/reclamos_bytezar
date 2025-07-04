@extends('layouts.app')

@section('content')
<div class="p-6 space-y-8">
    <h1 class="text-3xl font-bold text-center mb-8">Panel de Reclamos</h1>

    {{-- Botones de acceso a otras funcionalidades --}}
    <div class="flex flex-wrap gap-4 justify-center mb-6">
        <a href="{{ route('reclamos.crear') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">➕ Crear Reclamo</a>

        {{-- Botón exclusivo para administradores --}}
        @if (Auth::user()?->isAdmin())
            <a href="{{ route('reclamos.admin') }}"
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-semibold transition-colors duration-300 shadow-md">
               🛠️ PANEL ADMIN
            </a>
        @endif
    </div>

    {{-- Solo este componente se muestra en el dashboard --}}
    <div class="bg-white rounded-lg shadow p-4">
        <livewire:reclamos.reclamo-list />
    </div>
</div>
@endsection
