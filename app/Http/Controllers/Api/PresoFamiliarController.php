<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Preso;
use App\Models\PresoFamiliares;
use Illuminate\Http\Request;

class PresoFamiliarController extends Controller
{
    public function index(PresoFamiliares $preso_familiares, $credencial)
    {
        return $preso_familiares->join('presos','presos.id', 'preso_familiares.preso_id')
                                ->select ('presos.nome as nome_preso','presos.prontuario', 'preso_familiares.*')
                                ->where('credencial',$credencial)
                                ->first();
                                
      }
}
