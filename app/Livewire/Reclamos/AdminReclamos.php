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

    public function mount()
    {
        $this->categorias = CategoriaReclamo::with('tipoReclamos.reclamos.user')->get();
    }

    public function actualizarEstado($id, $estado)
    {
        $reclamo = Reclamo::findOrFail($id);
        if ($reclamo->user_id === Auth::id()) {
            $reclamo->estado = $estado;
            $reclamo->save();
            $this->mount(); // recargar datos
        }
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
        return view('livewire.reclamos.admin-reclamos')
        ->extends('layouts.app')->section('content'); // usa tu layout de siempre
    }
}
