<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cubiculo;
use Illuminate\Http\Request;

class CubiculoController extends Controller
{
    public function __construct(Cubiculo $cubiculos)
    {
        $this->cubiculo = $cubiculos;
    }

    public function presosPorCubiculo(Request $request){
        return $this->cubiculo->where("cubiculos.id", $request["id"])
                                ->with('presos')
                                ->get();
    }
}
