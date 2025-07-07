<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $fillable = ['reclamo_id', 'contenido'];

    public function reclamo()
    {
        return $this->belongsTo(Reclamo::class);
    }
}
