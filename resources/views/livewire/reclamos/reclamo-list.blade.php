<div class="p-4">
    <h2 class="text-2xl font-bold mb-6">📋 Mis Reclamos</h2>

    {{-- Filtros --}}
    <div class="flex flex-wrap gap-4 mb-6">
        {{-- Categoría --}}
        <div>
            <label class="block text-sm font-medium mb-1">Categoría:</label>
            <select wire:model.lazy="categoria_id" class="border rounded px-3 py-2">
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
    <table class="table-auto w-full text-left border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Categoría</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reclamos as $reclamo)
                <tr>
                    <td class="border px-4 py-2">{{ $reclamo->id }}</td>
                    <td class="border px-4 py-2">{{ optional($reclamo->tipo->categoria)->nombre ?? '—' }}</td>
                    <td class="border px-4 py-2">{{ optional($reclamo->tipo)->nombre ?? '—' }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $reclamo->estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-4">Aún no realizaste reclamos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
