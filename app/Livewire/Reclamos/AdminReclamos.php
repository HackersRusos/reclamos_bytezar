<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\CategoriaReclamo;
use App\Models\Reclamo;
use App\Models\User;

class AdminReclamos extends Component
{
    public $categorias;
    public $categoriaActiva;
    public $tipoReclamoActivo = [];
    public $resumenPorCategoria = [];
  

    public function mount()
    {
        $this->categorias = CategoriaReclamo::with('tipoReclamos.reclamos.user')->get();
        $this->categoriaActiva = $this->categorias->first()?->id;

        foreach ($this->categorias as $cat) {
            if ($cat->tipoReclamos->isNotEmpty()) {
                $this->tipoReclamoActivo[$cat->id] = $cat->tipoReclamos->first()->id;
            }
        }
    }

    public function calcularResumen()
    {
        $this->resumenPorCategoria = [];

        foreach ($this->categorias as $cat) {
            $pendientes = 0;
            $resueltos = 0;

            foreach ($cat->tipoReclamos as $tipo) {
                $pendientes += $tipo->reclamos->whereIn('estado', [
                    Reclamo::ESTADO_PENDIENTE, 
                    Reclamo::ESTADO_NUEVO
                ])->count();

                $resueltos += $tipo->reclamos->where('estado', Reclamo::ESTADO_RESUELTO)->count();
            }

            $this->resumenPorCategoria[$cat->id] = [
                'pendientes' => $pendientes,
                'resueltos' => $resueltos,
            ];
        }
    }

    public function verificarNuevosReclamos()
    {
        $ultimo = Reclamo::latest('id')->first();
        $nuevoId = $ultimo?->id ?? 0;
        $nuevoTotalPendientes = Reclamo::where('estado', 'pendiente')->count();
    
        if ($nuevoId > $this->ultimoId || $nuevoTotalPendientes > $this->reclamosPendientes) {
            $this->ultimoId = $nuevoId;
            $this->reclamosPendientes = $nuevoTotalPendientes;
    
            // Emitimos un evento para JavaScript
            $this->dispatch('reclamoCreadoGlobal', ['message' => '¡Nuevo reclamo recibido!']);
        }
    }

    
    public function actualizarEstado($id, $estado)
    {
        $reclamo = Reclamo::findOrFail($id);
        
        if ($estado === 'nuevo') {
            $reclamo->estado = 'pendiente';
            $reclamo->save();
            $this->mount(); // Esto ya recalcula $categorias
        }elseif($estado === 'pendiente'){
            $reclamo->estado ='resuelto';
            $reclamo->save();
            $this->mount(); // Esto ya recalcula $categorias
        }
    }

    public function setCategoriaActiva($id)
    {
        $this->categoriaActiva = $id;

        $categoria = $this->categorias->firstWhere('id', $id);
        if ($categoria && $categoria->tipoReclamos->isNotEmpty()) {
            $this->tipoReclamoActivo[$id] = $categoria->tipoReclamos->first()->id;
        }
    }

    public function setTipoActivo($categoriaId, $tipoId)
    {
        $this->tipoReclamoActivo[$categoriaId] = $tipoId;
    }

    public function render()
    {
        $this->calcularResumen(); // ⚠️ Esto actualiza el resumen siempre antes de pintar la vista

        return view('livewire.reclamos.admin-reclamos')
            ->extends('layouts.app')
            ->section('content');
    }
}
