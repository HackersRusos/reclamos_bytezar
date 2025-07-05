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

    public function mount()
    {
        // Guardamos el ID más reciente y el conteo actual
        $ultimo = Reclamo::latest('id')->first();
        $this->ultimoId = $ultimo?->id ?? 0;
        $this->reclamosPendientes = Reclamo::where('estado', 'pendiente')->count();
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

    public function render()
    {
       $this->verificarNuevosReclamos();

        return view('livewire.reclamos.admin-reclamos', [
            'categorias' => CategoriaReclamo::with('tipoReclamos.reclamos.user')->get(),
            'reclamosPendientes' => $this->reclamosPendientes,
        ])->extends('layouts.app')->section('content');
    }
}
