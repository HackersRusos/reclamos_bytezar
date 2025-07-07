<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamo;

class ReclamoController extends Controller
{
    public function responder(Request $request, $id)
    {
        $request->validate([
            'respuesta' => 'required|string',
        ]);

        $reclamo = Reclamo::findOrFail($id);
        $reclamo->respuesta = $request->input('respuesta');
        $reclamo->respondido = true;
        $reclamo->estado = Reclamo::ESTADO_RESUELTO; // opcional si usás estados
        $reclamo->save();

        return redirect()->back()->with('success', 'Respuesta guardada correctamente.');
    }
}
