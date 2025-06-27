<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reclamo;
use Illuminate\Support\Facades\Auth;

class ReclamoEstado extends Component
{
    public $reclamos;

    public function mount()
    {
        $this->reclamos = Reclamo::with('tipo')->where('user_id', Auth::id())->get();
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

    public function render()
    {
        return view('livewire.reclamo-estado');
    }
}
