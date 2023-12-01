<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    public function vacacion()
    {
        return $this->belongsTo('App\Models\Vacacion', 'vacacion_id', 'id');
    }

    public function dias()
    {
        return $this->hasMany('App\Models\Dia');
    }

    // public function zona()
    // {
    //     return $this->belongsTo('App\Models\Zona', 'zona_id', 'id');
    // }

    // public function scopeOfEstado($query, $type)
    // {
    //   if ($type != "") {
    //     return $query->where('estado', $type);
    //   }
    // }
}
