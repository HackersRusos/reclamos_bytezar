<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class GestionUsuarios extends Component
{
    public function quitarAdmin($id)
    {
    $usuario = User::find($id);
    
    if ($usuario && $usuario->isAdmin()) {
        $usuario->is_admin = false;
        $usuario->save();
        session()->flash('message', "El usuario {$usuario->name} ya no es administrador.");
    }
    }

        public function eliminarUsuario($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $nombre = $usuario->name;
            $usuario->delete();
            session()->flash('message', "El usuario {$nombre} fue eliminado correctamente.");
        }
    }
        public function hacerAdmin($id)
    {
        $usuario = User::find($id);
        if ($usuario && !$usuario->isAdmin()) {
            $usuario->is_admin = true;
            $usuario->save();
            session()->flash('message', "El usuario {$usuario->name} ahora es administrador.");
        }
    }
    
public function render()
{
    return view('livewire.admin.gestion-usuarios', [
        'usuarios' => User::all()
    ])->extends('layouts.app')
      ->section('content');
}


}
