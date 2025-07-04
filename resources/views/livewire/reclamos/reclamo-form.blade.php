<div class="p-4 max-w-xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Nuevo Reclamo (Bytezar)</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        {{-- CATEGORÍA --}}
        <div class="mb-4">
            <label for="categoria_id" class="block font-medium">Categoría del Reclamo:</label>
            <select wire:model.lazy="categoria_id" class="w-full border px-3 py-2 rounded" id="categoria_id">
                <option value="">-- Selecciona una categoría --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- TIPO DE RECLAMO --}}
        <div class="mb-4">
            <label for="tipo_reclamo_id" class="block font-medium">Tipo de Reclamo:</label>
            <select wire:model.lazy="tipo_reclamo_id" class="w-full border px-3 py-2 rounded" id="tipo_reclamo_id">
                <option value="">
                    @if($this->categoria_id)
                        -- Selecciona un tipo --
                    @else
                        -- Primero selecciona una categoría --
                    @endif
                </option>
            
                @foreach ($this->tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500">Tipos disponibles: {{ $this->tipos->count() }}</p>
            @error('tipo_reclamo_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- DESCRIPCIÓN --}}
        <div class="mb-4">
            <label for="descripcion" class="block font-medium">Descripción:</label>
            <textarea wire:model="descripcion" class="w-full border px-3 py-2 rounded" rows="4"></textarea>
            @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enviar Reclamo</button>
    </form>
</div>
