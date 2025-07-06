<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div id="loginContainer" class="max-w-md mx-auto p-8 rounded-lg shadow-lg bg-white dark:bg-gray-900 transition-colors duration-500">
        <!-- Dark Mode Toggle -->
        <div class="flex justify-end mb-4">
            <button id="darkModeToggle" type="button" 
                class="p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                aria-label="Toggle Dark Mode">
                <!-- Sol apagado (modo claro) -->
                <svg id="sunOff" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="5" />
                  <line x1="12" y1="1" x2="12" y2="3" />
                  <line x1="12" y1="21" x2="12" y2="23" />
                  <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                  <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                  <line x1="1" y1="12" x2="3" y2="12" />
                  <line x1="21" y1="12" x2="23" y2="12" />
                  <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                  <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                </svg>
                <!-- Sol prendido (modo oscuro) -->
                <svg id="sunOn" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="5" />
                  <line x1="12" y1="1" x2="12" y2="3" />
                  <line x1="12" y1="21" x2="12" y2="23" />
                  <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                  <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                  <line x1="1" y1="12" x2="3" y2="12" />
                  <line x1="21" y1="12" x2="23" y2="12" />
                  <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                  <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300 font-semibold" />
                <x-text-input id="email" class="block mt-1 w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 dark:focus:border-indigo-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" 
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-semibold" />
                <x-text-input id="password" class="block mt-1 w-full rounded-md border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 dark:focus:border-indigo-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="mb-6 flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                    {{ __('Remember me') }}
                </label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded dark:text-indigo-400 dark:hover:text-indigo-300">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3 px-6 py-2">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-300">
                ¿No tenés una cuenta?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Registrate</a>
            </p>
        </form>
    </div>

    <script>
        const toggleButton = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        const loginContainer = document.getElementById('loginContainer');

        // Carga el estado guardado en localStorage o por defecto modo claro
        if(localStorage.getItem('darkMode') === 'true') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        toggleButton.addEventListener('click', () => {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            } else {
                html.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            }
        });
    </script>
</x-guest-layout>
