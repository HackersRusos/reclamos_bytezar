@extends('layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Mis Reclamos</h1>
    <a href="{{ route('reclamos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuevo Reclamo</a>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">pena</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reclamos as $reclamo)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $reclamo->id }}</td>
                <td class="px-4 py-2">{{ $reclamo->descripcion }}</td>
                <td class="px-4 py-2">{{ $reclamo->tipo->nombre }}</td>
                <td class="px-4 py-2">{{ $reclamo->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
