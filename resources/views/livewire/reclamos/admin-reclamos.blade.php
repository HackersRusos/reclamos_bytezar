<div class="p-6">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Panel de Reclamos (Admin)</h2>

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
                                <li class="p-2 bg-gray-50 border rounded flex justify-between items-center">
                                    <div>
                                        <p><strong>Usuario:</strong> {{ $reclamo->user->name ?? 'Sin nombre' }}</p>
                                        <p><strong>Estado:</strong> {{ ucfirst($reclamo->estado) }}</p>
                                        <p><strong>Desc:</strong> {{ $reclamo->descripcion }}</p>
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
