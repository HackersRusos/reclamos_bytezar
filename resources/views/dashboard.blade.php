@extends('layouts.app')

@section('content')
<div id="dashboardContainer" class="max-w-4xl mx-auto p-8 rounded-lg shadow-lg bg-white dark:bg-gray-900 transition-colors duration-500">

    @if (auth()->user()?->isAdmin())
        <div class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 p-4 rounded shadow text-center mb-6">
            ⚠️ Estás accediendo al panel de usuarios, pero sos administrador. Usá el <a href="{{ route('reclamos.admin') }}" class="underline text-blue-600 dark:text-blue-400">Panel de Administración</a>.
        </div>
    @endif

    <h1 class="text-3xl font-bold text-center mb-8 text-gray-900 dark:text-gray-100">Panel de Reclamos</h1>

    {{-- Botones de acceso a otras funcionalidades --}}
    <div class="flex flex-wrap gap-4 justify-center mb-6">
        <a href="{{ route('reclamos.crear') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors duration-300">➕ Crear Reclamo</a>
    </div>

    {{-- Solo este componente se muestra en el dashboard --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 transition-colors duration-300">
        <livewire:reclamos.reclamo-list />
    </div>
</div>
@endsection
