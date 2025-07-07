<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\Reclamo;

class ResponderReclamo extends Component
{
    public $reclamoId;
    public $respuesta;
    public $mostrarFormulario = false;

    protected $rules = [
        'respuesta' => 'required|string|min:5',
    ];

    public function mount($reclamoId)
    {
        $this->reclamoId = $reclamoId;
    }

    public function responder()
    {
        $this->validate();

        $reclamo = Reclamo::findOrFail($this->reclamoId);
        $reclamo->respuesta = $this->respuesta;
        $reclamo->respondido = true;
        $reclamo->save();

        $this->respuesta = '';
        $this->mostrarFormulario = false;

        $this->emit('reclamoRespondido');
    }

    public function toggleFormulario()
    {
        $this->mostrarFormulario = !$this->mostrarFormulario;
    }

    public function render()
    {
        return view('livewire.reclamos.responder-reclamo');
    }
}
