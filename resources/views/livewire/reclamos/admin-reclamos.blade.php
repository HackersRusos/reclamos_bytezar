<div x-data @sesion-expirada.window="window.location.href = '/login'" wire:poll.3s>
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Panel de Reclamos (Admin)</h2>

    {{-- Notificación de nuevo reclamo --}}
    <div
        x-data="{ showNotification: false, message: '' }"
        x-init="
            $wire.on('reclamoCreadoGlobal', e => {
                const audio = new Audio('{{ asset('sounds/notificacion.mp3') }}');
                audio.play();
                showNotification = true;
                message = e.message;
                setTimeout(() => showNotification = false, 10000);
            });
        "
        x-show="showNotification"
        class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-300 shadow transition-all duration-500"
    >
        🔔 ¡Nuevo reclamo recibido!
    </div>

    {{-- Contador de reclamos pendientes --}}
    <div class="mb-4 bg-blue-100 border border-blue-300 text-blue-700 px-4 py-2 rounded shadow-sm inline-block">
        🆕 Reclamos pendientes: <strong>{{ $reclamosPendientes }}</strong>
    </div>

    {{-- Mensaje flash --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

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

    {{-- Contenido dinámico de reclamos --}}
    <div class="space-y-10">
        @foreach ($categorias as $categoria)
            @if ($categoriaActiva === $categoria->id)
                <section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground">
                    @foreach ($categoria->tipoReclamos as $tipo)
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold text-muted-foreground mb-2">→ {{ $tipo->nombre }}</h4>
                            @if ($tipo->reclamos->isEmpty())
                                <p class="text-sm text-muted-foreground italic">Sin reclamos</p>
                            @else
                                <ul class="space-y-2">
                                    @foreach ($tipo->reclamos as $reclamo)
                                        <li class="p-4 bg-muted border rounded flex justify-between items-center text-foreground">
                                            <div>
                                                <p><strong>Usuario:</strong> {{ $reclamo->user->name ?? 'Sin nombre' }}</p>
                                                <p><strong>Estado:</strong> {{ ucfirst($reclamo->estado) }}</p>
                                                <p><strong>Desc:</strong> {{ $reclamo->descripcion }}</p>
                                                <p><strong>Fecha:</strong> {{ $reclamo->created_at->format('d/m/Y H:i') }} ({{ $reclamo->created_at->diffForHumans() }})</p>
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
        <section class="p-6 bg-card border rounded shadow-md text-card-foreground">
            <h3 class="text-2xl font-bold mb-4 text-foreground">Gestión de Usuarios</h3>
            <ul class="divide-y divide-border">
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
</div>
