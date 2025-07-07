<section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6">
    <header>
        <h2 class="text-2xl font-bold text-foreground">Cambiar contraseña</h2>
        <p class="mt-1 text-sm text-muted-foreground">Asegúrate de usar una contraseña segura.</p>
    </header>

    <form method="post" action="{{ route('profile.password.update') }}" class="mt-6 space-y-6">

        @csrf
        @method('patch')

        <div>
            <x-input-label for="current_password" value="Contraseña actual" class="text-foreground" />
            <x-text-input id="current_password" name="current_password" type="password"
                          class="mt-1 block w-full bg-background text-foreground" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2 text-destructive" />
        </div>

        <div>
            <x-input-label for="password" value="Nueva contraseña" class="text-foreground" />
            <x-text-input id="password" name="password" type="password"
                          class="mt-1 block w-full bg-background text-foreground" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-destructive" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirmar nueva contraseña" class="text-foreground" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                          class="mt-1 block w-full bg-background text-foreground" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-destructive" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Guardar</x-primary-button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-muted-foreground">Contraseña actualizada.</p>
            @endif
        </div>
    </form>
</section>
