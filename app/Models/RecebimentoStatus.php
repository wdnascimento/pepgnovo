<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecebimentoStatus extends Model
{
    protected $table = 'recebimento_status';
    protected $fillable = ['id', 'preso_id','recebimento_id', 'inicio', 'fim', 'status','cadastrado_por', 'desc_status'];

    public function getDescStatusAttribute()
    {
        $codes = new TableCodes();
        return $codes->getDescricaoById(9, $this->status);    
    }

}
