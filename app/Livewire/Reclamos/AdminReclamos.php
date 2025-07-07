<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\CategoriaReclamo;
use App\Models\Reclamo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminReclamos extends Component
{
    public $categorias;
    public $categoriaActiva;
    public $tipoReclamoActivo = [];
    public $resumenPorCategoria = [];
    public $search = '';

  

    public function mount()
    {
    // Cargamos las categorías solo para inicializar datos, sin relaciones profundas
    $this->categorias = CategoriaReclamo::with('tipoReclamos')->get();

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

    public function actualizarEstado($id)
    {
        $reclamo = Reclamo::findOrFail($id);
    
        // Transición de estado basada en el actual
        if ($reclamo->estado === 'nuevo') {
            $reclamo->estado = 'pendiente';
        } elseif ($reclamo->estado === 'pendiente') {
            $reclamo->estado = 'resuelto';
        }
    
        $reclamo->save();
       
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
