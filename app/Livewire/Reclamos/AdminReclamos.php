<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\CategoriaReclamo;
use App\Models\Reclamo;
use App\Models\User;

class AdminReclamos extends Component
{
    public $ultimoId = 0;
    public $reclamosPendientes = 0;

    public $categorias;
    public $categoriaActiva;
    public $tipoReclamoActivo = [];
    public $resumenPorCategoria = [];

    public function mount()
    {
        // Notificaciones
        $ultimo = Reclamo::latest('id')->first();
        $this->ultimoId = $ultimo?->id ?? 0;
        $this->reclamosPendientes = Reclamo::where('estado', 'pendiente')->count();

        // Cargar datos
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

            $this->dispatch('reclamoCreadoGlobal', ['message' => '¡Nuevo reclamo recibido!']);
        }
    }

    public function actualizarEstado($id, $estado)
    {
        $reclamo = Reclamo::findOrFail($id);

        if ($estado === 'nuevo') {
            $reclamo->estado = 'pendiente';
        } elseif ($estado === 'pendiente') {
            $reclamo->estado = 'resuelto';
        } else {
            $reclamo->estado = $estado;
        }

        $reclamo->save();
        $this->mount(); // refresca los datos
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
        $this->verificarNuevosReclamos();
        $this->calcularResumen();

        return view('livewire.reclamos.admin-reclamos', [
            'categorias' => $this->categorias,
            'reclamosPendientes' => $this->reclamosPendientes,
            'resumenPorCategoria' => $this->resumenPorCategoria,
        ])->extends('layouts.app')->section('content');
    }
}
