<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ["descricao","categoria","unidade_medida","controlado_almox",'periodicidade',"observacao"];
    
    public function getDescControladoAlmoxAttribute()
    {
        return $this->controlado_almox ? 'SIM' : 'NÃO' ;  
    }

}
