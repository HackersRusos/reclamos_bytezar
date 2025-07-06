<section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6 max-w-4xl mx-auto">
    <h3 class="text-3xl font-bold text-foreground mb-6">Gestión de Usuarios</h3>

    @if (session()->has('message'))
        <div class="mb-6 p-3 rounded bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900">
            {{ session('message') }}
        </div>
    @endif

    <ul class="space-y-2">
        @foreach ($usuarios as $user)
            <li class="p-4 bg-muted border rounded flex justify-between items-start text-foreground gap-4">
                {{-- Info usuario --}}
                <div class="flex-1 space-y-1 break-words">
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>

                {{-- Acciones --}}
                <div class="flex flex-col gap-2 min-w-[12rem] text-right">
                    @if ($user->isAdmin())
                        <span class="text-green-600 text-sm font-semibold">Administrador</span>
                        <button 
                            wire:click="quitarAdmin({{ $user->id }})"
                            class="w-full px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-yellow-600"
                        >
                            Quitar Admin
                        </button>
                    @else
                        <button 
                            wire:click="hacerAdmin({{ $user->id }})"
                            class="w-full px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700"
                        >
                            Hacer Admin
                        </button>
                        <button 
                            wire:click="eliminarUsuario({{ $user->id }})"
                            class="w-full px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-yellow-600"
                        >
                            Eliminar
                        </button>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</section>
