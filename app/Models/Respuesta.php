<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $fillable = ['reclamo_id', 'contenido', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function reclamo()
    {
        return $this->belongsTo(Reclamo::class);
    }
}
