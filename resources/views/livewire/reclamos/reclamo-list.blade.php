<div class="p-4">
    <h2 class="text-2xl font-bold mb-6">Mis Reclamos</h2>

    {{-- Filtros + Botón --}}
    <div class="flex flex-wrap items-end gap-4 mb-6">

        {{-- Categoría --}}
        <div>
            <label class="block text-sm font-medium mb-1">Categoría:</label>
            <select wire:model.lazy="categoria_id"
                class="border rounded px-3 py-2 bg-background text-foreground placeholder:text-muted-foreground dark:placeholder:text-zinc-400">
                <option value="">Todas</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tipo --}}
        <div>
            <label class="block text-sm font-medium mb-1">Tipo:</label>
            <select wire:model="tipo_reclamo_id"
                class="border rounded px-3 py-2 bg-background text-foreground placeholder:text-muted-foreground dark:placeholder:text-zinc-400">
                <option value="">Todos</option>
                @foreach ($this->tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Estado --}}
        <div>
            <label class="block text-sm font-medium mb-1">Estado:</label>
            <select wire:model.lazy="estado"
                class="border rounded px-3 py-2 bg-background text-foreground placeholder:text-muted-foreground dark:placeholder:text-zinc-400">
                <option value="">Todos</option>
                <option value="pendiente">Pendiente</option>
                <option value="resuelto">Resuelto</option>
            </select>
        </div>

        {{-- Botón Crear Reclamo alineado a la derecha --}}
        <div class="ml-auto">
            <a href="{{ route('reclamos.crear') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors duration-300 whitespace-nowrap">
                Crear Reclamo
            </a>
        </div>
    </div>

    {{-- Botón Limpiar filtros --}}
    <button wire:click="limpiarFiltros"
        class="px-4 py-2 bg-gray-300 dark:bg-zinc-700 text-black dark:text-white rounded hover:bg-gray-400 dark:hover:bg-zinc-600 text-sm">
        Limpiar filtros
    </button>

    {{-- Tabla --}}
    <table class="table-auto w-full text-left border mt-6">
        <thead>
            <tr class="bg-gray-100 dark:bg-zinc-800 dark:border-gray-600">
                <th class="px-4 py-2 border dark:border-gray-600">ID</th>
                <th class="px-4 py-2 border dark:border-gray-600">Categoría</th>
                <th class="px-4 py-2 border dark:border-gray-600">Tipo</th>
                <th class="px-4 py-2 border dark:border-gray-600">Estado</th>
                <th class="px-4 py-2 border dark:border-gray-600">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reclamos as $reclamo)
                <tr class="border-b border-muted dark:border-gray-600">
                    <td class="px-4 py-2 border dark:border-gray-600">{{ $reclamo->id }}</td>
                    <td class="px-4 py-2 border dark:border-gray-600">{{ optional($reclamo->tipo->categoria)->nombre ?? '—' }}</td>
                    <td class="px-4 py-2 border dark:border-gray-600">{{ optional($reclamo->tipo)->nombre ?? '—' }}</td>
                    <td class="px-4 py-2 capitalize border dark:border-gray-600">{{ $reclamo->estado }}</td>
                    <td class="px-4 py-2 border dark:border-gray-600">
                        <button wire:click="verRespuestas({{ $reclamo->id }})"
                            class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700">
                            Ver respuestas
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"
                        class="text-center text-gray-500 dark:text-white/80 border dark:border-gray-600 py-4">
                        Aún no realizaste reclamos.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

   {{-- Modal de respuestas --}}
        @if ($reclamoSeleccionado)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white dark:bg-zinc-900 p-6 rounded shadow-lg w-full max-w-lg text-foreground dark:text-white">
                    <h2 class="text-lg font-bold mb-4 text-foreground dark:text-white">
                        Respuestas al reclamo: {{ $reclamoSeleccionado->titulo }}
                    </h2>
        
                    <ul class="list-disc list-inside space-y-2 text-foreground dark:text-zinc-200">
                        @forelse ($reclamoSeleccionado->respuestas as $respuesta)
                            <li>
                                <strong>Admin ({{ $respuesta->admin->name ?? 'Desconocido' }}):</strong>
                                {{ $respuesta->contenido }}
                                <div class="text-xs text-muted-foreground dark:text-zinc-400">
                                    {{ $respuesta->created_at->format('d/m/Y H:i') }}
                                </div>
                            </li>
                        @empty
                            <li class="text-muted-foreground dark:text-zinc-400">
                                Aún no hay respuestas para este reclamo.
                            </li>
                        @endforelse
                    </ul>
        
                    <button wire:click="cerrarModal"
                        class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                        Cerrar
                    </button>
                </div>
            </div>
        @endif
</div>