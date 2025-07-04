<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Mis Reclamos</h2>

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
                    <td class="border px-4 py-2">{{ $reclamo->estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-4">Aún no realizaste reclamos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
