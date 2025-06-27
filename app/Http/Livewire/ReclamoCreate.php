<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reclamo;
use App\Models\TipoReclamo;
use Illuminate\Support\Facades\Auth;

class ReclamoCreate extends Component
{
    public $descripcion, $tipo_reclamo_id;
    public $tipos;

    protected $rules = [
        'descripcion' => 'required|min:10',
        'tipo_reclamo_id' => 'required|exists:tipo_reclamos,id',
    ];

    public function mount()
    {
        $this->tipos = TipoReclamo::with('categoria')->get();
    }

    public function submit()
    {
        $this->validate();

        Reclamo::create([
            'descripcion' => $this->descripcion,
            'tipo_reclamo_id' => $this->tipo_reclamo_id,
            'user_id' => Auth::id(),
            'estado' => 'pendiente',
        ]);

        session()->flash('message', 'Reclamo enviado correctamente.');
        $this->reset(['descripcion', 'tipo_reclamo_id']);
    }

    public function render()
    {
        return view('livewire.reclamos.create');
    }
}
