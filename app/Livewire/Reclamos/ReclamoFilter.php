<?php

namespace App\Livewire\Reclamos;

use Livewire\Component;
use App\Models\Reclamo;
use Illuminate\Support\Facades\Auth;

class ReclamoFilter extends Component
{
    public $estado = '';

    public function render()
    {
        $query = Reclamo::with('tipo')->where('user_id', Auth::id());

        if ($this->estado !== '') {
            $query->where('estado', $this->estado);
        }

        return view('livewire.reclamos.reclamo-filter', [
            'reclamos' => $query->get(),
        ])->extends('layouts.app')->section('content'); // usa tu layout de siempre
    }
}
