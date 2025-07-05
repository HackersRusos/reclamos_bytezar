<?php
namespace App\Http\Controllers;

use App\Models\Reclamo;
use App\Models\TipoReclamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReclamoController extends Controller
{
    public function index()
    {
        $reclamos = Reclamo::with('tipo')->where('user_id', Auth::id())->get();
        return view('reclamos.index', compact('reclamos'));
    }

    public function create()
    {
        $tipos = TipoReclamo::all();
        return view('reclamos.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'tipo_reclamo_id' => 'required|exists:tipo_reclamos,id',
        ]);

        Reclamo::create([
            'descripcion' => $request->descripcion,
            'tipo_reclamo_id' => $request->tipo_reclamo_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('reclamos.index')->with('success', 'Reclamo enviado correctamente');
    }
}