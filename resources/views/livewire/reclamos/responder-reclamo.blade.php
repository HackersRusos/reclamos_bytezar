<div class="text-right">
    @if (!$reclamo->respondido)
        @if ($mostrarFormulario)
            <form wire:submit.prevent="responder" class="mt-2">
                <textarea wire:model.defer="respuesta" rows="3"
                    class="w-full border rounded p-2 text-sm"
                    placeholder="Escribí tu respuesta..."></textarea>
                @error('respuesta') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                <div class="flex gap-2 mt-2 justify-end">
                    <button type="submit"
                        class="bg-green-600 text-white px-3 py-1 text-sm rounded hover:bg-green-700">
                        Enviar respuesta
                    </button>
                    <button type="button"
                        wire:click="toggleFormulario"
                        class="px-3 py-1 border text-sm rounded">
                        Cancelar
                    </button>
                </div>
            </form>
        @else
            <button wire:click="toggleFormulario"
                class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700">
                Responder
            </button>
        @endif
    @else
        <div class="p-2 bg-background border rounded text-center">
            <strong class="text-green-800">Resuelto</strong>
            <p class="text-sm text-green-700 font-semibold">Ya fue respondido</p>
        </div>
    @endif
</div>