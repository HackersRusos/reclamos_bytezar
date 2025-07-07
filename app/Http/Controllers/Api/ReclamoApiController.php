<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriaReclamo;
use App\Models\Reclamo;
use App\Models\User;


class ReclamoApiController extends Controller
{
   public function reclamosPorEstado()
    {
    $estados = ['nuevo', 'pendiente', 'resuelto'];

    $data = [];

    foreach ($estados as $estado) {
        $data[$estado] = Reclamo::with(['user:id,name', 'tipo.categoria'])
            ->where('estado', $estado)
            ->get();
    }

    return response()->json($data);
    }

    public function reclamosPorUsuario(Request $request)
{
    $nombreUsuario = $request->input('usuario');

    if (!$nombreUsuario) {
        return response()->json(['error' => 'Falta el parámetro "usuario".'], 400);
    }

    $usuario = User::where('name', $nombreUsuario)->first();

    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado.'], 404);
    }

    $reclamos = Reclamo::with(['tipo:id,nombre', 'tipo.categoria:id,nombre'])
    ->where('user_id', $usuario->id)
    ->get(['id', 'estado', 'descripcion', 'tipo_reclamo_id']);

    $resultado = $reclamos->map(function ($reclamo) use ($usuario) {
        return [
            'estado' => $reclamo->estado,
            'descripcion' => $reclamo->descripcion,
            'usuario' => $usuario->name,
            'tipo_reclamo' => $reclamo->tipo->nombre ?? 'Sin tipo',
            
        ];
    });

    return response()->json($resultado);
    }

   
        
}

