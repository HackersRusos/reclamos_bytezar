<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\CategoriaReclamo;
use App\Models\TipoReclamo;
use App\Models\Reclamo;
use Illuminate\Support\Facades\Auth;

class ReclamoForm extends Component
{
    public $categoria_id;
    public $tipo_reclamo_id;
    public $descripcion;

    public function updatedCategoriaId()
    {
        $this->tipo_reclamo_id = null; // Reinicia tipo cuando cambia categoría
    }

    public function submit()
    {
        $this->validate([
            'categoria_id' => 'required|exists:categoria_reclamos,id',
            'tipo_reclamo_id' => 'required|exists:tipo_reclamos,id',
            'descripcion' => 'required|string',
        ]);

        Reclamo::create([
            'tipo_reclamo_id' => $this->tipo_reclamo_id,
            'descripcion' => $this->descripcion,
            'user_id' => Auth::id(),
        ]);

        //()->flash('message', 'Reclamo enviado correctamente.');
        //$this->reset(['categoria_id', 'tipo_reclamo_id', 'descripcion']);
        return redirect()->route('dashboard')->with('message', 'Reclamo enviado correctamente.');
    }

    #[Computed]
    public function tipos()
    {
        return $this->categoria_id
            ? TipoReclamo::where('categoria_reclamo_id', $this->categoria_id)->get()
            : collect();
    }

    public function render()
    {
        
        return view('livewire.reclamos.reclamo-form', [
            'categorias' => CategoriaReclamo::all(),
        ])->extends('layouts.app')->section('content');
    }
}
