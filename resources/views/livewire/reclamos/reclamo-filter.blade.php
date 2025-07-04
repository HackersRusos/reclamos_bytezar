<div class="p-4">
    <h2 class="text-xl font-semibold mb-4">Filtrar Reclamos por Estado</h2>

    <div class="mb-4">
        <label class="block font-medium">Estado:</label>
        <select wire:model="estado" class="border px-3 py-2 rounded">
            <option value="">-- Todos --</option>
            <option value="pendiente">Pendiente</option>
            <option value="resuelto">Resuelto</option>
        </select>
    </div>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reclamos as $reclamo)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $reclamo->id }}</td>
                    <td class="px-4 py-2">{{ $reclamo->descripcion }}</td>
                    <td class="px-4 py-2">{{ $reclamo->tipo->nombre }}</td>
                    <td class="px-4 py-2">{{ $reclamo->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
