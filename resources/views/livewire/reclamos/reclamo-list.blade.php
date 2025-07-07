<div x-data @sesion-expirada.window="window.location.href = '/login'" wire:poll.3s>
    <h2 class="text-2xl font-bold mb-6">📋 Mis Reclamos</h2>

    {{-- Filtros --}}
    <div class="flex flex-wrap gap-4 mb-6">
        {{-- Categoría --}}
        <div>
            <label class="block text-sm font-medium mb-1">Categoría:</label>
            <select wire:model="categoria_id" class="border rounded px-3 py-2">
                <option value="">Todas</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tipo --}}
        <div>
            <label class="block text-sm font-medium mb-1">Tipo:</label>
            <select wire:model="tipo_reclamo_id" class="border rounded px-3 py-2">
                <option value="">Todos</option>
                @foreach ($this->tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Estado --}}
        <div>
            <label class="block text-sm font-medium mb-1">Estado:</label>
            <select wire:model.lazy="estado" class="border rounded px-3 py-2">
                <option value="">Todos</option>
                <option value="pendiente">Pendiente</option>
                <option value="resuelto">Resuelto</option>
            </select>
        </div>
    </div>

    <button wire:click="limpiarFiltros"
        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm">
        Limpiar filtros
    </button>

    {{-- Tabla --}}
    <table class="table-auto w-full text-left border mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Categoría</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th> {{-- Nueva columna --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($reclamos as $reclamo)
                <tr>
                    <td class="border px-4 py-2">{{ $reclamo->id }}</td>
                    <td class="border px-4 py-2">{{ optional($reclamo->tipo->categoria)->nombre ?? '—' }}</td>
                    <td class="border px-4 py-2">{{ optional($reclamo->tipo)->nombre ?? '—' }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $reclamo->estado }}</td>

                    <td class="border px-4 py-2">
                        @if($reclamo->respondido)
                            <span class="text-green-600 font-semibold">Respondido</span><br>
                            <small>{{ $reclamo->respuesta }}</small>
                        @else
                            @if(auth()->user()->isAdmin())
                                @livewire('reclamos.responder-reclamo', ['reclamoId' => $reclamo->id], key($reclamo->id))
                            @else
                                <span class="text-red-600 font-semibold">Pendiente</span>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">Aún no realizaste reclamos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
