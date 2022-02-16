<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;

    function computadores()
    {
        return $this->belongsToMany(Computador::class, 'computador_oficina', 'oficina_id', 'computador_id')->withTimeStamps();
    }
}
