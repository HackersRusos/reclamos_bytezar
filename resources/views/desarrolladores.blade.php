@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-100 mb-10">
            👥 Equipo de Desarrollo
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @php
                $desarrolladores = [
                    ['nombre' => 'Gabriela Heretichi', 'imagen' => 'Gabriela.jpg'],
                    ['nombre' => 'Gustavo Gines', 'imagen' => 'Gustavo.jpg'],
                    ['nombre' => 'Leandro Nacimento', 'imagen' => 'Leandro.jpg'],
                    ['nombre' => 'Vera Sofía', 'imagen' => 'Sofia.jpg'],
                    ['nombre' => 'Manuel Recalde', 'imagen' => 'Manu.jpg'],
                    ['nombre' => 'Javier Quintana', 'imagen' => 'Jajo.jpg'],
                ];
            @endphp

            @foreach($desarrolladores as $dev)
                <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md text-center">
                    <img src="{{ asset('images/desarrolladores/' . $dev['imagen']) }}"
                         alt="{{ $dev['nombre'] }}"
                         class="w-24 h-24 rounded-full mx-auto mb-4 shadow object-cover">

                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $dev['nombre'] }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">
                        Estudiante de Tecnicatura Universitaria en Programación
                    </p>
                    <p class="text-gray-600 dark:text-gray-400">UTN – Extensión áulica Formosa</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Año del proyecto: 2025</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
