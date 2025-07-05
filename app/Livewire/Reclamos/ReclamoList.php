<?php

namespace App\Livewire\Reclamos;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Reclamo;
use App\Models\CategoriaReclamo;
use App\Models\TipoReclamo;
use Illuminate\Support\Facades\Auth;

class ReclamoList extends Component
{
    public $categoria_id = '';
    public $tipo_reclamo_id = '';
    public $estado = '';
    public $categorias = [];

    public function mount()
    {
         $this->categorias = \App\Models\CategoriaReclamo::with('tipoReclamos')->get();
    }



    #[Computed]
    public function tipos()
    {
        return $this->categoria_id
            ? TipoReclamo::where('categoria_reclamo_id', $this->categoria_id)->get()
            : collect();
    }

    public function limpiarFiltros()
    {
        $this->reset(['categoria_id', 'tipo_reclamo_id', 'estado']);
    }

    public function render()
    {
        $query = Reclamo::with('tipo.categoria')
            ->where('user_id', Auth::id());
    
        if ($this->categoria_id) {
            $query->whereHas('tipo.categoria', function ($q) {
                $q->where('id', $this->categoria_id);
            });
        }
    
        if ($this->tipo_reclamo_id) {
            $query->where('tipo_reclamo_id', $this->tipo_reclamo_id);
        }
    
        if ($this->estado !== '') {
            $query->where('estado', $this->estado);
        }
    
        return view('livewire.reclamos.reclamo-list', [
            'reclamos' => $query->get()
        ])->extends('layouts.app')->section('content');
    }

}
