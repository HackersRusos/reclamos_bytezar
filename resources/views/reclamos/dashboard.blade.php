@extends('layouts.app')

@section('content')
<div class="p-6 space-y-8">
    <h1 class="text-3xl font-bold text-center mb-8">Panel de Reclamos</h1>

    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-xl font-semibold mb-2">📤 Crear Reclamo</h2>
        @livewire('reclamo-form')
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-xl font-semibold mb-2">📋 Lista de Reclamos (Live)</h2>
        @livewire('reclamo-list')
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-xl font-semibold mb-2">🔍 Filtro por Estado</h2>
        @livewire('reclamo-filter')
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-xl font-semibold mb-2">✏️ Editar Estado</h2>
        @livewire('reclamo-estado')
    </div>
</div>
@endsection
