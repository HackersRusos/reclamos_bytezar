@extends('layouts.app')

@section('content')
<div class="p-6 space-y-8"> 

    @if (session('message'))
    <div class="bg-green-100 text-green-700 border px-4 py-2 rounded mb-4 text-center">
        {{ session('message') }}
    </div>
    @endif

    @if (auth()->user()?->isAdmin())
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow text-center mb-6">
            ⚠️ Estás accediendo al panel de usuarios, pero sos administrador. Usá el <a href="{{ route('reclamos.admin') }}" class="underline text-blue-600">Panel de Administración</a>.
        </div>
    @endif
    <h1 class="text-3xl font-bold text-center mb-8">Panel de Reclamos</h1>

    {{-- Botones de acceso a otras funcionalidades --}}
    <div class="flex flex-wrap gap-4 justify-center mb-6">
        <a href="{{ route('reclamos.crear') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">➕ Crear Reclamo</a>
    </div>

    {{-- Solo este componente se muestra en el dashboard --}}
    <div class="bg-white rounded-lg shadow p-4">
        <livewire:reclamos.reclamo-list />
    </div>
</div>
@endsection
