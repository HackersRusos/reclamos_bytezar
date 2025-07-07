
<section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6 max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-foreground mb-6">Panel de Reclamos (Admin)</h2>

    {{-- Tabs de Categorías --}}
    <nav class="flex flex-wrap gap-2 mb-6 border-b">
        @foreach ($categorias as $categoria)
             @php
            $resumen = $resumenPorCategoria[$categoria->id] ?? ['pendientes' => 0, 'resueltos' => 0];
            @endphp

            <button 
                wire:click="setCategoriaActiva({{ $categoria->id }})"
                class="px-4 py-2 text-sm font-medium border-b-2 transition-colors duration-200 
                    {{ $categoriaActiva === $categoria->id 
                        ? 'border-primary text-primary' 
                        : 'border-transparent text-muted-foreground hover:text-foreground hover:border-muted' }}">
                {{ $categoria->nombre }} ({{ $resumen['pendientes'] }}/{{ $resumen['resueltos'] }})
            </button>
        @endforeach

    </nav>

    {{-- Contenido dinámico --}}
    <div class="space-y-10">
        @foreach ($categorias as $categoria)
            @if ($categoriaActiva === $categoria->id)
                <section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground">

                    {{-- Navbar de Tipos de Reclamos --}}
                   <nav class="flex flex-wrap gap-2 mb-6 border-b">
                        @foreach ($categoria->tipoReclamos as $tipo)
                            @php
                                $countPendientes = $tipo->reclamos->whereIn('estado', [
                                    \App\Models\Reclamo::ESTADO_PENDIENTE,
                                    \App\Models\Reclamo::ESTADO_NUEVO
                                ])->count();
                            @endphp

                            <button 
                                wire:click="setTipoActivo({{ $categoria->id }}, {{ $tipo->id }})"
                                class="px-4 py-2 text-sm font-medium border-b-2 transition-colors duration-200 
                                    {{ ($tipoReclamoActivo[$categoria->id] ?? null) === $tipo->id 
                                        ? 'border-primary text-primary' 
                                        : 'border-transparent text-muted-foreground hover:text-foreground hover:border-muted' }}"
                            >
                                {{ $tipo->nombre }} ({{ $countPendientes }})
                            </button>
                        @endforeach
                    </nav>

                    {{-- Mostrar reclamos solo del tipo activo --}}
                    @foreach ($categoria->tipoReclamos as $tipo)
                        @if (($tipoReclamoActivo[$categoria->id] ?? null) === $tipo->id)
                            <div class="mb-6">
                                <h4 class="text-xl font-semibold text-muted-foreground mb-2"> {{ $tipo->nombre }}</h4>
                                @if ($tipo->reclamos->isEmpty())
                                    <p class="text-sm text-muted-foreground italic">Sin reclamos</p>
                                @else
                                    <ul class="space-y-2">
                                        @foreach ($tipo->reclamos as $reclamo)
                                            <li class="p-4 bg-muted border rounded flex justify-between items-start text-foreground gap-4">

                                                {{-- Información del reclamo --}}
                                                <div class="flex-1 space-y-2 break-words">
                                                    <p><strong>Usuario:</strong> {{ $reclamo->user->name ?? 'Sin nombre' }}</p>
                                                    <p><strong>Estado:</strong> {{ ucfirst($reclamo->estado) }}</p>

                                                    <div class="p-3 bg-background border rounded text-foreground">
                                                        <p class="font-semibold text-sm mb-1">Descripción:</p>
                                                        <p class="text-sm">{{ $reclamo->descripcion }}</p>
                                                    </div>
                                                </div>

                                                {{-- Acciones del reclamo --}}
                                                <div class="flex flex-col gap-3 min-w-[16rem] text-right">

                                                    {{-- NUEVO → mostrar "Marcar como pendiente" y "Responder" --}}
                                                    @if ($reclamo->estado === 'nuevo' && $mostrarFormularioId !== $reclamo->id)
                                                        <button 
                                                            wire:click="actualizarEstado({{ $reclamo->id }}, 'pendiente')"
                                                            class="px-3 py-1 bg-yellow-600 text-white text-sm rounded hover:bg-yellow-700">
                                                            Marcar como pendiente
                                                        </button>
                                                    @endif

                                                    {{-- MOSTRAR FORMULARIO --}}
                                                    @if (!$reclamo->respondido)
                                                        @if ($mostrarFormularioId === $reclamo->id)
                                                            {{-- Solo muestra el formulario si está activo --}}
                                                            <form wire:submit.prevent="responder({{ $reclamo->id }})" class="mt-2">
                                                                <textarea wire:model.defer="respuesta" rows="3"
                                                                    class="w-full border rounded p-2 text-sm"
                                                                    placeholder="Escribí tu respuesta..."></textarea>
                                                                @error('respuesta') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                                                                <div class="flex gap-2 mt-2">
                                                                    <button type="submit"
                                                                        class="bg-green-600 text-white px-3 py-1 text-sm rounded hover:bg-green-700">
                                                                        Enviar respuesta
                                                                    </button>
                                                                    <button type="button"
                                                                        wire:click="toggleFormulario(null)"
                                                                        class="px-3 py-1 border text-sm rounded">
                                                                        Cancelar
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        @else
                                                            {{-- Mostrar botón para abrir formulario --}}
                                                            <button 
                                                                wire:click="toggleFormulario({{ $reclamo->id }})"
                                                                class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700">
                                                                Responder
                                                            </button>
                                                        @endif
                                                    @else
                                                        {{-- Ya fue respondido --}}
                                                        <div class="p-2 bg-background border rounded text-center">
                                                            <strong class="text-green-800">Resuelto</strong>
                                                            <p class="text-sm text-green-700 font-semibold">Ya fue respondido</p>
                                                        </div>
                                                    @endif

                                                </div>

                                            </li>
                                        @endforeach

                                    </ul>
                                @endif
                            </div>
                        @endif
                    @endforeach

                </section>
            @endif
        @endforeach
    </div>
</section>
