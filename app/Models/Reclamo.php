<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_RESUELTO = 'resuelto';
    const ESTADO_NUEVO = 'nuevo';

    protected $fillable = ['descripcion', 'tipo_reclamo_id', 'user_id', 'estado'];

    public function tipo()
    {
        return $this->belongsTo(TipoReclamo::class, 'tipo_reclamo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function respuestas()
    {
    return $this->hasMany(Respuesta::class);
    }

    public function ultimaRespuesta()
    {
        return $this->hasOne(Respuesta::class)->latestOfMany();
    }
}
