<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'nombre_proyecto',
        'descripcion',
        'estado_id',
        'fecha_inicio',
        'fecha_termino',
        'user_id',
        'imagen', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class); // Relación inversa con Material
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class); // Relación inversa con Material
    }
}
