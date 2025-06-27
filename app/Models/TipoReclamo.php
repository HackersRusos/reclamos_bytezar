<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoReclamo extends Model
{
    protected $fillable = ['nombre', 'categoria_reclamo_id'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaReclamo::class);
    }

    public function reclamos()
    {
        return $this->hasMany(Reclamo::class);
    }
}
