<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeria;
use App\Models\Preso;
use App\Models\Cubiculo;
use App\Models\PresoKit;
use App\Models\PresoFamiliares;
use App\Models\Recebimento;
use App\Models\Triagem;
use App\Models\RecebimentoStatus;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private $params = [];
    private $preso;
    private $galeria;
    private $cubiculo;
    private $preso_kits;
    private $preso_familiares;
    private $recebimento;
    private $recebimento_status;


    public function __construct(Galeria $galerias,Preso $presos,Cubiculo $cubiculos, PresoKit $preso_kits, PresoFamiliares $preso_familiares, Recebimento $recebimento, RecebimentoStatus $recebimento_status)
    {
        $this->galeria = $galerias;
        $this->preso = $presos;
        $this->cubiculo = $cubiculos;
        $this->preso_kits = $preso_kits;
        $this->preso_familiares = $preso_familiares;
        $this->recebimento = $recebimento;
        $this->recebimento_status = $recebimento_status;

        //$this->atendimento = $atendimentos;


        // Default values
        $this->params['titulo']='Seja Bem-Vindo';
        $this->params['main_route']='admin';
        

    }


    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='';

        $params = $this->params;
        $data['total_presos'] = $this->galeria->totalPresos();
        $data['preso'] = $this->preso->count();
        $data['cubiculo'] = $this->cubiculo->count();
        $data['preso_kits'] = $this->preso_kits->count();
        $data['credencial'] = $this->preso_familiares->count();
        $data['id'] = $this->recebimento->count();
        $data['status'] = $this->recebimento_status->count();
        
        return view('admin.index',compact('params','data'));
    }
}
