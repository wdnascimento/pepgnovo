<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cubiculo extends Model
{
    protected $fillable = ['galeria_id','numero','capacidade']; 

    public function getCubiculoIdGaleriaCubiculo($galeria, $cubiculo){
         return $this   ->join('galerias','galerias.id','cubiculos.galeria_id')
                        ->select('cubiculos.id')
                        ->where('galerias.titulo',$galeria)
                        ->where('cubiculos.numero',$cubiculo)
                        ->get();
    }

    public function presos()
    {
        return $this->belongsToMany(Preso::class,'preso_alojamentos','cubiculo_id','preso_id')->where('preso_alojamentos.data_saida',NULL);
    }
}