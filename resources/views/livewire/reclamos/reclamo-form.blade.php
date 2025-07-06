<div id="reclamoContainer" class="p-8 max-w-xl mx-auto rounded-lg shadow-lg bg-white dark:bg-gray-900 transition-colors duration-500">
    <h2 class="text-3xl font-bold text-center mb-8 text-gray-900 dark:text-gray-100">Nuevo Reclamo (Bytezar)</h2>

    @if (session()->has('message'))
        <div class="bg-green-50 dark:bg-green-800 border border-green-300 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-2 rounded mb-6 transition-colors duration-300">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <div>
            <label for="categoria_id" class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Categoría del Reclamo:</label>
            <select wire:model.lazy="categoria_id" id="categoria_id"
                class="block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                       px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 dark:focus:border-indigo-400 transition">
                <option value="">-- Selecciona una categoría --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="tipo_reclamo_id" class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Tipo de Reclamo:</label>
            <select wire:model.lazy="tipo_reclamo_id" id="tipo_reclamo_id"
                class="block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                       px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 dark:focus:border-indigo-400 transition">
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
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Tipos disponibles: {{ $this->tipos->count() }}</p>
            @error('tipo_reclamo_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="descripcion" class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Descripción:</label>
            <textarea wire:model="descripcion" id="descripcion" rows="4"
                class="block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                       px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 dark:focus:border-indigo-400 transition"></textarea>
            @error('descripcion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded transition-colors duration-300">
            Enviar Reclamo
        </button>
    </form>
</div>
