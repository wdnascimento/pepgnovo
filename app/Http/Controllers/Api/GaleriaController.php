<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cubiculo;
use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    private $galeria, $cubiculo;

    public function __construct(Galeria $galerias, Cubiculo $cubiculos)
    {
        $this->galeria = $galerias;
        $this->cubiculo = $cubiculos;
    }
    
    public function index()
    {
        return $this->galeria->get();
    }
    
    public function cubiculosGaleria($id){
        return $this->cubiculo->where('galeria_id', $id)->get();
    }
}
