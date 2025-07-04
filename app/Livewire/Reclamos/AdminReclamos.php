<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\CategoriaReclamo;
use App\Models\Reclamo;

class AdminReclamos extends Component
{
    public $categorias;

    public function mount()
    {
        $this->categorias = CategoriaReclamo::with('tipoReclamos.reclamos.user')->get();
    }

    public function marcarResuelto($id)
    {
        $reclamo = Reclamo::find($id);
        if ($reclamo) {
            $reclamo->estado = 'resuelto';
            $reclamo->save();
        }
    }

    public function render()
    {
        return view('livewire.reclamos.admin-reclamos')
        ->extends('layouts.app')->section('content'); // usa tu layout de siempre
    }
}
