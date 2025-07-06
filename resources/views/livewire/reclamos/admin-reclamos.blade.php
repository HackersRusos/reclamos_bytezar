<div class="p-6 space-y-6">
    <h2 class="text-3xl font-bold text-foreground mb-6">Panel de Reclamos (Admin)</h2>

    {{-- Tabs de Categorías --}}
    <nav class="flex flex-wrap gap-2 mb-6 border-b">
        @foreach ($categorias as $categoria)
            <button 
                wire:click="setCategoriaActiva({{ $categoria->id }})"
                class="px-4 py-2 text-sm font-medium border-b-2 transition-colors duration-200 
                    {{ $categoriaActiva === $categoria->id 
                        ? 'border-primary text-primary' 
                        : 'border-transparent text-muted-foreground hover:text-foreground hover:border-muted' }}"
            >
                {{ $categoria->nombre }}
            </button>
        @endforeach
    </nav>

    {{-- Categoría activa --}}
    @foreach ($categorias as $categoria)
        @if ($categoriaActiva === $categoria->id)
            <section class="p-6 border rounded-lg bg-white shadow-md">
                @foreach ($categoria->tipoReclamos as $tipo)
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold text-muted-foreground mb-2">→ {{ $tipo->nombre }}</h4>
                        @if ($tipo->reclamos->isEmpty())
                            <p class="text-sm text-gray-400 italic">Sin reclamos</p>
                        @else
                            <ul class="space-y-2">
                                @foreach ($tipo->reclamos as $reclamo)
                                    <li class="p-4 bg-gray-50 border rounded flex justify-between items-center">
                                        <div>
                                            <p><strong>Usuario:</strong> {{ $reclamo->user->name ?? 'Sin nombre' }}</p>
                                            <p><strong>Estado:</strong> {{ ucfirst($reclamo->estado) }}</p>
                                            <p><strong>Desc:</strong> {{ $reclamo->descripcion }}</p>
                                        </div>

                                        <div class="flex gap-2">
                                            @if ($reclamo->estado === 'pendiente')
                                                <button 
                                                    wire:click="actualizarEstado({{ $reclamo->id }}, 'resuelto')"
                                                    class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700"
                                                >
                                                    Marcar como resuelto
                                                </button>
                                            @endif

                                            @if ($reclamo->estado === 'resuelto')
                                                <button 
                                                    wire:click="actualizarEstado({{ $reclamo->id }}, 'pendiente')"
                                                    class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600"
                                                >
                                                    Marcar como pendiente
                                                </button>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </section>
        @endif
    @endforeach

    {{-- Gestión de usuarios --}}
    <section class="mt-10 p-6 bg-white border rounded shadow-md">
        <h3 class="text-2xl font-bold mb-4 text-foreground">Gestión de Usuarios</h3>
        <ul class="divide-y">
            @foreach (\App\Models\User::all() as $user)
                <li class="py-3 flex justify-between items-center">
                    <div>
                        <p><strong>{{ $user->name }}</strong> - {{ $user->email }}</p>
                    </div>
                    @if ($user->isAdmin())
                        <span class="text-green-600 text-sm font-semibold">Administrador</span>
                    @else
                        <button 
                            wire:click="hacerAdmin({{ $user->id }})"
                            class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600"
                        >
                            Hacer Admin
                        </button>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
</div>
