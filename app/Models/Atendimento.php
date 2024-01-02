<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $fillable = ['preso_id','setor_id','url_audio', 'url_audio_resposta', 'resposta_texto', 'desc_respondido','respondido','desc_lido', 'lido','created_at']; 

    public function getDescRespondidoAttribute()
    {
        return $this->respondido ? 'SIM' : 'NÃO' ;  
    }

    public function getDescLidoAttribute()
    {
        return $this->lido ? 'SIM' : 'NÃO' ;  
    }
}
