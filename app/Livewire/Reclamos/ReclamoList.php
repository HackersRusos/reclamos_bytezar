<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\Reclamo;
use Illuminate\Support\Facades\Auth;

class ReclamoList extends Component
{
    public function render()
    {
        $reclamos = Reclamo::with('tipo.categoria')
            ->where('user_id', Auth::id())
            ->get();
        
        return view('livewire.reclamos.reclamo-list', [
            'reclamos' => $reclamos
        ])->extends('layouts.app')->section('content'); // usa tu layout de siempre
    }
}
