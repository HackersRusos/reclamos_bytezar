<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Reclamo;

Route::middleware('auth:sanctum')->get('/reclamos', function (Request $request) {
    return Reclamo::with('tipo.categoria')->where('user_id', $request->user()->id)->get();
});
