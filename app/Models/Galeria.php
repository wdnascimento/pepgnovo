<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $fillable = ["unidade_id","titulo","tipo"];


    public function cubiculos()
    {
        return $this->hasMany(Cubiculo::class);

    }

    public function totalPresos($id = NULL){
        if($id != NULL){
            return $this->join('cubiculos','cubiculos.galeria_id','galerias.id')
                    ->join('preso_alojamentos','preso_alojamentos.cubiculo_id','cubiculos.id')
                    ->where('data_saida',NULL)
                    ->where('galerias.id',$id)
                    ->count();
        }
        return $this->join('cubiculos','cubiculos.galeria_id','galerias.id')
                    ->join('preso_alojamentos','preso_alojamentos.cubiculo_id','cubiculos.id')
                    ->where('data_saida',NULL)
                    ->count();
        
    }
    
}
