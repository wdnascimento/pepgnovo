<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preso extends Model
{
    protected $fillable = ['prontuario','nome','rg','mae','data_nascimento','artigos'
                            ,'situacao','origem','url_foto','data_prisao','data_depen','data_entrada',
                            'preso_alojamento','preso_kit']; 

    public function getPresoKitAttribute()
    {
        $preso_kit = new PresoKit(); 
        $kit = $preso_kit->select('kit')->where('preso_id',$this->id)->where('data_final',NULL)->first();
        return ($kit != null) ? $kit->kit : '-' ;  
    }

    public function getIdFromProntuario($prontuario){
        $preso = new Preso(); 
        if($kit = $preso->select('id')->where('prontuario',$prontuario)->first()){
            return $kit->id;
        }
        return null;
        
    }


    
}    
