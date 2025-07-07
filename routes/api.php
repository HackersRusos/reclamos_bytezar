<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Reclamo;
use App\Http\Controllers\Api\ReclamoApiController;

Route::middleware('auth:sanctum')->get('/reclamos', function (Request $request) {
    return Reclamo::with('tipo.categoria')->where('user_id', $request->user()->id)->get();
});

Route::get('/reclamos-por-estado', [ReclamoApiController::class, 'reclamosPorEstado']);

Route::get('/reclamos-por-usuario', [ReclamoApiController::class, 'reclamosPorUsuario']);

Route::get('/resumen-usuario', [ReclamoApiController::class, 'resumenPorUsuario']);

