<div>
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
    <main class="bg-blue-100 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        {{ $slot }}
    </main>

    <!-- Dark Mode Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButtons = [
                document.getElementById('darkModeToggle'),
                document.getElementById('darkModeToggleMobile')
            ];
            const html = document.documentElement;

            if (localStorage.getItem('darkMode') === 'true') {
                html.classList.add('dark');
            }

            toggleButtons.forEach(btn => {
                btn?.addEventListener('click', () => {
                    html.classList.toggle('dark');
                    localStorage.setItem('darkMode', html.classList.contains('dark'));
                });
            });
        });
    </script>
</div>
