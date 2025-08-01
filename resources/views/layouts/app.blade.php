<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '') }}</title>

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

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        @livewireScripts

        <!-- Dark Mode Script -->
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
<footer class="bg-gray-200 dark:bg-gray-900 text-center text-sm text-gray-600 dark:text-gray-400 py-4 mt-12">
    Desarrolladores –
    <a href="{{ route('desarrolladores') }}" class="underline hover:text-blue-600 dark:hover:text-blue-400">
        Ver más
    </a>
</footer>

    </body>
</html>

