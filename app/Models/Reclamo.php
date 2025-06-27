<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    protected $fillable = ['descripcion', 'tipo_reclamo_id', 'user_id', 'estado'];

    public function tipo()
    {
        return $this->belongsTo(TipoReclamo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
