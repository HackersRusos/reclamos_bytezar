<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\Reclamo;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Auth;

class ResponderReclamo extends Component
{
    public $reclamoId;
    public $respuesta = '';
    public $mostrarFormulario = false;
    public $reclamo;

    protected $rules = [
        'respuesta' => 'required|string|min:5',
    ];

    public function mount($reclamoId)
    {
        $this->reclamoId = $reclamoId;
        $this->reclamo = Reclamo::with('respuestas', 'user')->findOrFail($reclamoId);
    }

    public function toggleFormulario()
    {
        $this->mostrarFormulario = !$this->mostrarFormulario;

        // Si es nuevo y se abre el formulario, lo pasamos a pendiente
        if ($this->mostrarFormulario && $this->reclamo->estado === 'nuevo') {
            $this->reclamo->estado = 'pendiente';
            $this->reclamo->save();
        }
    }

    public function responder()
    {
        $this->validate();

        // Guardamos la respuesta en la tabla respuestas
        Respuesta::create([
            'reclamo_id' => $this->reclamo->id,
            'contenido' => $this->respuesta,
            'admin_id' => Auth::id(),
        ]);

        // Marcamos el reclamo como resuelto
        $this->reclamo->estado = 'resuelto';
        $this->reclamo->save();

        $this->respuesta = '';
        $this->mostrarFormulario = false;
    }

    public function render()
    {
        $this->reclamo->refresh(); // Actualiza relaciones
        return view('livewire.reclamos.responder-reclamo');
    }
}
