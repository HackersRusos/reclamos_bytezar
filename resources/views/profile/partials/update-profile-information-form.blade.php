<section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6 max-w-4xl mx-auto">
    <header>
        <h2 class="text-2xl font-bold text-foreground">Información del perfil</h2>
        <p class="mt-1 text-sm text-muted-foreground">Actualiza el nombre y correo electrónico de tu cuenta.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Campo: Nombre --}}
        <div>
            <x-input-label for="name" value="Nombre" class="text-foreground" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full bg-background text-foreground"
                :value="old('name', Auth::user()->name)"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-destructive" />
        </div>

        {{-- Campo: Correo electrónico --}}
        <div>
            <x-input-label for="email" value="Correo electrónico" class="text-foreground" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full bg-background text-foreground"
                :value="old('email', Auth::user()->email)"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-destructive" />
        </div>

        {{-- Botón para guardar --}}
        <div class="flex items-center gap-4">
            <x-primary-button>
                Guardar
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600 dark:text-green-400">Perfil actualizado correctamente.</p>
            @endif
        </div>
    </form>
</section>
