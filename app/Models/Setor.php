<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $fillable = ["titulo","responsavel","atendimento_online"];

    public function getDescAtendimentoOnlineAttribute()
    {
        return $this->atendimento_online ? 'SIM' : 'NÃO' ;  
    }

}
