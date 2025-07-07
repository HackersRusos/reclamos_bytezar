<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\Reclamo;

class ResponderReclamo extends Component
{
    public $reclamoId;
    public $respuesta = '';
    public $mostrarFormulario = false;

    protected $rules = [
        'respuesta' => 'required|string|min:5',
    ];

    public function mount($reclamoId)
    {
        $this->reclamoId = $reclamoId;
    }

    public function toggleFormulario()
    {
        $this->mostrarFormulario = !$this->mostrarFormulario;
    }

    public function responder()
    {
        $this->validate();

        $reclamo = Reclamo::findOrFail($this->reclamoId);
        $reclamo->respuesta = $this->respuesta;
        $reclamo->respondido = true;
        $reclamo->estado = 'resuelto'; // Marca automáticamente como resuelto
        $reclamo->save();

        $this->respuesta = '';
        $this->mostrarFormulario = false;
    }

    public function render()
    {
        $reclamo = Reclamo::find($this->reclamoId);

        return view('livewire.reclamos.responder-reclamo', [
            'reclamo' => $reclamo,
        ]);
    }
}
