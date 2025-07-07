<div class="text-right">
    @if (!$reclamo->respondido)
        @if ($mostrarFormulario)
            <form wire:submit.prevent="responder" class="mt-2">
                <textarea wire:model.defer="respuesta" rows="3"
                    class="w-full border rounded p-2 text-sm bg-white dark:bg-zinc-800 text-black dark:text-white placeholder:text-muted-foreground dark:placeholder:text-zinc-400"
                    placeholder="Escribí tu respuesta..."></textarea>
                @error('respuesta')
                    <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span>
                @enderror

                <div class="flex gap-2 mt-2 justify-end">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 text-sm rounded transition">
                        Enviar respuesta
                    </button>
                    <button type="button"
                        wire:click="toggleFormulario"
                        class="px-3 py-1 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm rounded text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-zinc-600 transition">
                        Cancelar
                    </button>
                </div>
            </form>
        @else
            <button wire:click="toggleFormulario"
                class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700 transition">
                Responder
            </button>
        @endif
    @else
        <div class="p-2 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 rounded text-center">
            <strong class="text-green-800 dark:text-green-300">Resuelto</strong>
            <p class="text-sm text-green-700 dark:text-green-400 font-semibold">Ya fue respondido</p>
        </div>
    @endif
</div>
