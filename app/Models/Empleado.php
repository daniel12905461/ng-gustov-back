<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public function vacaciones()
    {
        return $this->hasMany('App\Models\Vacacion');
    }

    public function scopeNombreApellido($query, $term)
    {
        if ($term) {
            $query->where('nombres', 'LIKE', '%' . $term . '%')->orWhere('apellidos', 'LIKE', '%' . $term . '%');
            // $query->orWhere('apellidos', 'LIKE', '%' . $term . '%');
        }

        return $query;
    }
}
