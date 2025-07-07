@php use Illuminate\Support\Facades\Auth; @endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Información del perfil</h2>
        <p class="mt-1 text-sm text-gray-600">Actualiza el nombre y correo electrónico de tu cuenta.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nombre" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', Auth::user()->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', Auth::user()->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-800">
                    Tu correo no está verificado.
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="text-blue-600 hover:underline">
                            Reenviar verificación
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Guardar</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">Guardado.</p>
            @endif
        </div>
    </form>
</section>
