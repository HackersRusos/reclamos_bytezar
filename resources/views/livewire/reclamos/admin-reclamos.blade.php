<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Panel de Reclamos (Admin)</h2>
    @foreach ($categorias as $categoria)
        <h3 class="text-xl mt-4 text-indigo-600">{{ $categoria->nombre }}</h3>
        @foreach ($categoria->tipoReclamos as $tipo)
            <h4 class="text-lg mt-2 text-gray-800">→ {{ $tipo->nombre }}</h4>
            <ul class="list-disc ml-6">
                @foreach ($tipo->reclamos as $reclamo)
                    <li class="mb-1">
                        <strong>Usuario:</strong> {{ $reclamo->user->name ?? 'Sin nombre' }} |
                        <strong>Estado:</strong> {{ $reclamo->estado }} |
                        <strong>Desc:</strong> {{ $reclamo->descripcion }} |
                        @if ($reclamo->estado === 'pendiente')
                            <button wire:click="marcarResuelto({{ $reclamo->id }})" class="ml-2 px-2 py-1 text-sm bg-green-500 text-white rounded">
                                Marcar como resuelto
                            </button>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endforeach
    @endforeach
</div>
