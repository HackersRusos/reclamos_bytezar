
<div x-data @sesion-expirada.window="window.location.href = '/login'" wire:poll.3s> {{-- actualiza cada 10 segundos --}}
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Panel de Reclamos (Admin)</h2>

    <div
        x-data="{ showNotification: false, message: '' }"
        x-init="
            $wire.on('reclamoCreadoGlobal', e => {
             const audio = new Audio('{{ asset('sounds/notificacion.mp3') }}');
                audio.play();
                showNotification = true;
                message = e.message; // ✅ no uses e.detail

                setTimeout(() => showNotification = false, 10000);
            });
        "
        x-show="showNotification"
        class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-300 shadow transition-all duration-500"
        >
         🔔 ¡Nuevo reclamo recibido!"
    </div>

    <div class="mb-4 bg-blue-100 border border-blue-300 text-blue-700 px-4 py-2 rounded shadow-sm inline-block">
     🆕 Reclamos pendientes: <strong>{{ $reclamosPendientes }}</strong>
    </div>
                   
    {{-- Mensaje flash --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    {{-- Reclamos organizados por categoría y tipo --}}
    @foreach ($categorias as $categoria)
        <div class="mb-6 p-4 border rounded bg-white shadow">
            <h3 class="text-2xl text-indigo-700 font-semibold mb-2">{{ $categoria->nombre }}</h3>

            @foreach ($categoria->tipoReclamos as $tipo)
                <div class="mb-4">
                    <h4 class="text-lg text-gray-700 font-medium mb-1">→ {{ $tipo->nombre }}</h4>
                    @if ($tipo->reclamos->isEmpty())
                        <p class="text-sm text-gray-400 italic">Sin reclamos</p>
                    @else
                        <ul class="space-y-1 ml-4">
                            @foreach ($tipo->reclamos as $reclamo)
                                @php
                                    $esNuevo = now()->diffInMinutes($reclamo->created_at) < 10;
                                @endphp
                                
                                <li class="p-2 border rounded flex justify-between items-center
                                    @if ($reclamo->estado === 'pendiente') bg-yellow-100 border-yellow-400
                                    @elseif ($esNuevo) bg-blue-100 border-blue-300
                                    @else bg-gray-50 @endif">
                                    <div>
                                        <p><strong>Usuario:</strong> {{ $reclamo->user->name ?? 'Sin nombre' }}</p>
                                        <p><strong>Estado:</strong> {{ ucfirst($reclamo->estado) }}</p>
                                        <p><strong>Desc:</strong> {{ $reclamo->descripcion }}</p>
                                        <p><strong>Fecha:</strong> {{ $reclamo->created_at->format('d/m/Y H:i') }} ({{ $reclamo->created_at->diffForHumans() }})</p>
                                    </div>
                                    @if ($reclamo->estado === 'pendiente')
                                        <button wire:click="actualizarEstado({{ $reclamo->id }}, 'resuelto')"
                                            class="ml-4 px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                            Marcar como resuelto
                                        </button>
                                    @endif
                                    @if ($reclamo->estado === 'resuelto')
                                        <button wire:click="actualizarEstado({{ $reclamo->id }}, 'pendiente')"
                                            class="ml-2 px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600">
                                            Marcar como pendiente
                                        </button>
                                    @endif
        
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach

    {{-- Panel de gestión de usuarios --}}
    <div class="mt-10 p-6 bg-white border rounded shadow">
        <h3 class="text-2xl font-bold mb-4 text-gray-800">Gestión de Usuarios</h3>

        <ul class="divide-y">
            @foreach (\App\Models\User::all() as $user)
                <li class="py-2 flex justify-between items-center">
                    <div>
                        <p><strong>{{ $user->name }}</strong> - {{ $user->email }}</p>
                    </div>

                    @if ($user->isAdmin())
                        <span class="text-green-600 text-sm font-semibold">Administrador</span>
                    @else
                        <button wire:click="hacerAdmin({{ $user->id }})"
                            class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                            Hacer Admin
                        </button>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
