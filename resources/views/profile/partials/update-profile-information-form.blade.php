<section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6 max-w-4xl mx-auto">
    <header>
        <h2 class="text-2xl font-bold text-foreground">Información del perfil</h2>
        <p class="mt-1 text-sm text-muted-foreground">Actualiza el nombre y correo electrónico de tu cuenta.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nombre" class="text-foreground" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-background text-foreground"
                          :value="old('name', Auth::user()->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-destructive" />
        </div>

        <div>
            <x-input-label for="email" value="Correo electrónico" class="text-foreground" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-background text-foreground"
                          :value="old('email', Auth::user()->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-destructive" />

            @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                <div class="mt-2 text-sm text-muted-foreground">
                    Tu correo no está verificado.
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-600 hover:underline dark:text-blue-400">
                            Reenviar verificación
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
