<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reclamo;

class ReclamoIndex extends Component
{
    public $reclamos;

    public function mount()
    {
        $this->reclamos = Reclamo::with('tipo.categoria')->where('user_id', auth()->id())->get();
    }

    public function render()
    {
        return view('livewire.reclamos.index');
    }
}
