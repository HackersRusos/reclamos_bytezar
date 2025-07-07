<section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6">
    <header>
        <h2 class="text-2xl font-bold text-foreground">Eliminar cuenta</h2>
        <p class="mt-1 text-sm text-muted-foreground">Una vez eliminada, no podrás recuperar tu cuenta.</p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
        @csrf
        @method('delete')

        <div>
            <x-input-label for="password" value="Confirmar contraseña" class="text-foreground" />
            <x-text-input id="password" name="password" type="password"
                          class="mt-1 block w-full bg-background text-foreground" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-destructive" />
        </div>

        <div class="flex items-center gap-4">
            <x-danger-button 
                onclick="return confirm('¿Estás seguro que deseas eliminar tu cuenta?')"
                class="bg-red-600 hover:bg-red-700 text-white dark:bg-red-700 dark:hover:bg-red-800"
            >
                Eliminar cuenta
            </x-danger-button>
        </div>
    </form>
</section>
