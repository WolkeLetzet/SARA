<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computador extends Model
{
    use HasFactory;
    protected $table = 'computadores';

    public function oficinas()
    {
        
        return $this->belongsToMany(Oficina::class, 'computador_oficina', 'computador_id', 'oficina_id')->withTimestamps();
        
    }



    public function tipo_usos()
    {
        return $this->belongsToMany(TipoUso::class, 'computador_tipo_usos', 'computador_id', 'tipo_uso_id');
    }

    /**
     * Get all of the comments for the Computador
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class)->where('estado',true);
    }

    public function scopeMarca($query,$marca){
        if($marca){
            return $query->where('marca','LIKE',"%$marca%");
        }
    }
    public function scopeEncargado($query,$encargado){
        if($encargado){
            return $query->orWhere('encargado','LIKE',"%$encargado%");
        }
    }

    public function scopeoficina($query,$oficina){
        if($oficina){
            return $query->whereHas('oficina','LIKE',"%$oficina%");
        }
    }
    public function scopeAvailable($query){

        return $query->where('estado',true);
    }
}
