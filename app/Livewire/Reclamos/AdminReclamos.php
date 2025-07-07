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

    public function mount()
    {
        // Para notificación de nuevos reclamos
        $ultimo = Reclamo::latest('id')->first();
        $this->ultimoId = $ultimo?->id ?? 0;
        $this->reclamosPendientes = Reclamo::where('estado', 'pendiente')->count();

        // Para organización por categorías
        $this->categorias = CategoriaReclamo::with('tipoReclamos.reclamos.user')->get();
        $this->categoriaActiva = $this->categorias->first()?->id;
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
        $reclamo->estado = $estado;
        $reclamo->save();
    }

    public function hacerAdmin($id)
    {
        $usuario = User::find($id);
        if ($usuario && !$usuario->isAdmin()) {
            $usuario->is_admin = true;
            $usuario->save();
            session()->flash('message', "El usuario {$usuario->name} ahora es administrador.");
        }
    }

    public function setCategoriaActiva($id)
    {
        $this->categoriaActiva = $id;
    }

    public function render()
    {
        $this->verificarNuevosReclamos();

        return view('livewire.reclamos.admin-reclamos', [
            'categorias' => $this->categorias,
            'reclamosPendientes' => $this->reclamosPendientes,
        ])->extends('layouts.app')->section('content');
    }
}