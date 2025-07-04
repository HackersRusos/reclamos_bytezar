<div class="p-4">
    <h2 class="text-xl font-semibold mb-4">Editar Estado de Reclamos</h2>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reclamos as $reclamo)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $reclamo->id }}</td>
                <td class="px-4 py-2">{{ $reclamo->descripcion }}</td>
                <td class="px-4 py-2">{{ $reclamo->tipo->nombre }}</td>
                <td class="px-4 py-2">{{ $reclamo->estado }}</td>
                <td class="px-4 py-2">
                    <button wire:click="actualizarEstado({{ $reclamo->id }}, 'resuelto')" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Marcar Resuelto</button>
                    <button wire:click="actualizarEstado({{ $reclamo->id }}, 'pendiente')" class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">Marcar Pendiente</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
