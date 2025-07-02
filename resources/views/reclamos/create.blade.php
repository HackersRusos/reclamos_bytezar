@extends('layouts.app')

@section('content')
<div class="p-4 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Nuevo Reclamo</h1>
    <form method="POST" action="{{ route('reclamos.store') }}">
        @csrf
        <div class="mb-4">
            <label for="tipo_reclamo_id" class="block font-medium">Categoría del Reclamo:</label>
            <select name="tipo_reclamo_id" class="w-full border px-3 py-2 rounded" required>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
                        <label for="tipo_reclamo_id" class="block font-medium">Tipo de Reclamo:</label>
            <select name="tipo_reclamo_id" class="w-full border px-3 py-2 rounded" required>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="descripcion" class="block font-medium">Descripción:</label>
            <textarea name="descripcion" class="w-full border px-3 py-2 rounded" rows="4" required></textarea>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Enviar Reclamo</button>
    </form>
</div>
@endsection
