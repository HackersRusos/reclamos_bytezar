<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bytezar</title>

        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-blue-100 dark:bg-gray-900 transition-colors duration-300">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- contenido de pagina -->
            <main>
                {{-- Si el componente usa slot (Livewire), se muestra --}}
                @isset($slot)
                    {{ $slot }}
                @else
                    {{-- Si la vista usa secciones tradicionales, se muestra esta --}}
                    @yield('content')
                @endisset
            </main>
        </div>

        @livewireScripts

        <!-- Modo oscuro -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const toggleButtons = [
                    document.getElementById('darkModeToggle'),
                    document.getElementById('darkModeToggleMobile')
                ];
                const html = document.documentElement;

                // Aplica el modo guardado en localStorage
                if (localStorage.getItem('darkMode') === 'true') {
                    html.classList.add('dark');
                }

                // Toggle y persistencia
                toggleButtons.forEach(btn => {
                    btn?.addEventListener('click', () => {
                        html.classList.toggle('dark');
                        localStorage.setItem('darkMode', html.classList.contains('dark'));
                    });
                });
            });
        </script>
    </body>
</html>

