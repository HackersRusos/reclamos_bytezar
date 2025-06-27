<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Nuevo Reclamo</h2>
    @if (session()->has('message'))
        <div class="p-2 mb-4 bg-green-200 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label for="tipo_reclamo_id">Tipo de reclamo:</label>
            <select wire:model="tipo_reclamo_id" class="w-full p-2 border rounded">
                <option value="">Seleccione una opción</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}">
                        {{ $tipo->categoria->nombre }} - {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>
            @error('tipo_reclamo_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea wire:model="descripcion" rows="4" class="w-full p-2 border rounded"></textarea>
            @error('descripcion') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enviar</button>
    </form>
</div>
