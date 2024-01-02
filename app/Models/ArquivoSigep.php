<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArquivoSigep extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
 
    // id, titulo, data_hora, importado, usuario, created_at, updated_at
 
    protected $fillable = ['titulo','data_hora','importado','usuario']; 

    public function getDescImportadoAttribute()
    {
        return $this->importado ? 'SIM' : 'NÃO' ;  
    }
}
    
