<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\CategoriaReclamo;
use App\Models\Reclamo;

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
                $pendientes += $tipo->reclamos->whereIn('estado', ['nuevo', 'pendiente'])->count();
                $resueltos += $tipo->reclamos->where('estado', 'resuelto')->count();
            }

            $this->resumenPorCategoria[$cat->id] = [
                'pendientes' => $pendientes,
                'resueltos' => $resueltos,
            ];
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

    public function actualizarEstado($id, $nuevoEstado = null)
    {
        $reclamo = Reclamo::findOrFail($id);

        if ($nuevoEstado) {
            $reclamo->estado = $nuevoEstado;
        } elseif ($reclamo->estado === 'nuevo') {
            $reclamo->estado = 'pendiente';
        } elseif ($reclamo->estado === 'pendiente') {
            $reclamo->estado = 'resuelto';
        }

        $reclamo->save();
    }

    public function render()
    {
        $this->calcularResumen();

        return view('livewire.reclamos.admin-reclamos', [
            'categorias' => $this->categorias,
            'categoriaActiva' => $this->categoriaActiva,
            'tipoReclamoActivo' => $this->tipoReclamoActivo,
            'resumenPorCategoria' => $this->resumenPorCategoria,
        ])
        ->extends('layouts.app')
        ->section('content');
    }
}