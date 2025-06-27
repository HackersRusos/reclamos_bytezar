<div class="p-4 max-w-xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Nuevo Reclamo (Livewire)</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="tipo_reclamo_id" class="block font-medium">Tipo de Reclamo:</label>
            <select wire:model="tipo_reclamo_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Selecciona un tipo --</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
            @error('tipo_reclamo_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block font-medium">Descripción:</label>
            <textarea wire:model="descripcion" class="w-full border px-3 py-2 rounded" rows="4"></textarea>
            @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enviar Reclamo</button>
    </form>
</div>
