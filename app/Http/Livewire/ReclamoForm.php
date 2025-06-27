<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reclamo;
use App\Models\TipoReclamo;
use Illuminate\Support\Facades\Auth;

class ReclamoForm extends Component
{
    public $tipo_reclamo_id;
    public $descripcion;

    public function submit()
    {
        $this->validate([
            'tipo_reclamo_id' => 'required|exists:tipo_reclamos,id',
            'descripcion' => 'required|string',
        ]);

        Reclamo::create([
            'tipo_reclamo_id' => $this->tipo_reclamo_id,
            'descripcion' => $this->descripcion,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', 'Reclamo enviado correctamente.');

        $this->reset(['tipo_reclamo_id', 'descripcion']);
    }

    public function render()
    {
        return view('livewire.reclamo-form', [
            'tipos' => TipoReclamo::all(),
        ]);
    }
}
