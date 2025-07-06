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


    public function actualizarEstado($id, $estado)
    {
        $reclamo = Reclamo::findOrFail($id);
        if ($reclamo->user_id === Auth::id()) {
            $reclamo->estado = $estado;
            $reclamo->save();
            $this->mount(); // recargar datos
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
        return view('livewire.reclamos.admin-reclamos')
            ->extends('layouts.app')
            ->section('content');
    }
}
