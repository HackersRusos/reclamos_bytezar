<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">Eliminar cuenta</h2>
        <p class="mt-1 text-sm text-gray-600">Una vez eliminada, no podrás recuperar tu cuenta.</p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
        @csrf
        @method('delete')

        <div>
            <x-input-label for="password" value="Confirmar contraseña" />
            <x-text-input id="password" name="password" type="password"
                          class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-danger-button onclick="return confirm('¿Estás seguro que deseas eliminar tu cuenta?')">
                Eliminar cuenta
            </x-danger-button>
        </div>
    </form>
</section>
