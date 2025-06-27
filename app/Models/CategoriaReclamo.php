<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaReclamo extends Model
{
    protected $fillable = ['nombre'];

    public function tipoReclamos()
    {
        return $this->hasMany(TipoReclamo::class);
    }
}
