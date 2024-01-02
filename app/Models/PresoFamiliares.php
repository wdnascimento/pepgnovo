<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresoFamiliares extends Model
{
    protected $fillable = ['preso_id', 'credencial', 'rg', 'cpf', 'nome', 'data_nascimento', 'afinidade', 'validade', 'status', 'tipo']; 
    
}
