<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PresoAlojamento extends Model
{
    
    protected $fillable = ['preso_id','cubiculo_id','data_entrada','data_saida','desc_galeria_cubiculo','motivo']; 
    
    public function cubiculos()
    {
        return $this->hasMany(Cubiculo::class);

    }   
    
    public function presos()
    {
        return $this->hasMany(Preso::class);

    }   

    
}