<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresoKit extends Model
{
    protected $fillable = ['kit','preso_id', 'data_inicial','data_final'];
}
