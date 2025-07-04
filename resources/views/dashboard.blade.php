@extends('layouts.app')

@section('content')
<div class="p-6 space-y-8">
    <h1 class="text-3xl font-bold text-center mb-8">Panel de Reclamos</h1>

    {{-- Botones de acceso a otras funcionalidades --}}
    <div class="flex flex-wrap gap-4 justify-center mb-6">
        <a href="{{ route('reclamos.crear') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">➕ Crear Reclamo</a>
        <a href="{{ route('reclamos.filtro') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">🔍 Filtrar Reclamos</a>
        <a href="{{ route('reclamos.estado') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">✏️ Editar Estado</a>
    </div>

    {{-- Solo este componente se muestra en el dashboard --}}
    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-xl font-semibold mb-2">📋 Lista de Reclamos (Live)</h2>
        <livewire:reclamos.reclamo-list />
    </div>
</div>
@endsection
