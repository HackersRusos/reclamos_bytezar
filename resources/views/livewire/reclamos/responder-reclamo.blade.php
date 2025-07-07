<div>
    @if($mostrarFormulario)
        <form wire:submit.prevent="responder" class="mt-2">
            <textarea wire:model.defer="respuesta" rows="3" class="w-full border rounded p-2" placeholder="Escribí tu respuesta..."></textarea>
            @error('respuesta') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-2 rounded">Enviar respuesta</button>
            <button type="button" wire:click="toggleFormulario" class="mt-2 ml-2 px-4 py-2 border rounded">Cancelar</button>
        </form>
    @else
        <button wire:click="toggleFormulario" class="bg-blue-600 text-white px-4 py-2 rounded">Responder</button>
    @endif
</div>
