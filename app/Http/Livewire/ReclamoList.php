<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reclamo;
use Illuminate\Support\Facades\Auth;

class ReclamoList extends Component
{
    public function render()
    {
        $reclamos = Reclamo::with('tipo')->where('user_id', Auth::id())->get();
        return view('livewire.reclamo-list', ['reclamos' => $reclamos]);
    }
}
