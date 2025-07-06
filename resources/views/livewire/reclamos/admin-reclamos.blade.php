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
                                               
                                                     <div class="flex-1 space-y-2 break-words">
                                                         <p><strong>Usuario:</strong> {{ $reclamo->user->name ?? 'Sin nombre' }}</p>
                                                         <p><strong>Estado:</strong> {{ ucfirst($reclamo->estado) }}</p>

                                                         {{-- Descripción --}}
                                                         <div class="p-3 bg-background border rounded text-foreground">
                                                             <p class="font-semibold text-sm mb-1">Descripción:</p>
                                                             <p class="text-sm">{{ $reclamo->descripcion }}</p>
                                                         </div>
                                                     </div>
                                                <div class="flex flex-col gap-2 min-w-[12rem] text-right">
                                                    @if ($reclamo->estado === 'pendiente')
                                                        <button 
                                                            wire:click="actualizarEstado({{ $reclamo->id }}, 'resuelto')"
                                                            class="w-full px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700"
                                                        >
                                                            Marcar como resuelto
                                                        </button>
                                                    @endif
                                                    @if ($reclamo->estado === 'resuelto')
                                                        <button 
                                                            wire:click="actualizarEstado({{ $reclamo->id }}, 'pendiente')"
                                                            class="w-full px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600"
                                                        >
                                                            Marcar como pendiente
                                                        </button>
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
</section>
     