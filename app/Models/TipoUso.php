<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUso extends Model
{
    use HasFactory;
    public function computadores()
    {
        return $this->belongsToMany(Computador::class, 'computador_tipo_usos', 'tipo_uso_id', 'computador_id');
    }
}
