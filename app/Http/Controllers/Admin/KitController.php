<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preso;
use App\Models\PresoAlojamento;
use App\Models\PresoKit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitController extends Controller
{
    private $preso_kit;
    private $preso;
    private $params;

    public function __construct(PresoKit $preso_kits, Preso $presos)
    {

        $this->preso_kit = $preso_kits;
        $this->preso = $presos;

        // Default values
        $this->params['titulo'] = 'Kit';
        $this->params['main_route'] = 'admin.preso_kit';
    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastro de Kit';
        $this->params['arvore'][0] = [
            'url' => 'admin/kit',
            'titulo' => 'Controle de Kit'
        ];

        $data_final = NULL;
        $params = $this->params;
        $data = $this->preso
                        ->select('preso_kits.id as id','preso_kits.kit','presos.prontuario','presos.nome','galerias.titulo as galeria'
                                ,'cubiculos.numero','presos.id as preso_id' )
                        ->join('preso_alojamentos','preso_alojamentos.preso_id','presos.id')
                        ->join('cubiculos','cubiculos.id','preso_alojamentos.cubiculo_id')
                        ->join('galerias','galerias.id','cubiculos.galeria_id')
                        ->leftJoin('preso_kits', function($join) use ($data_final) {
                            $join   ->on('preso_kits.preso_id','presos.id')
                                    ->where(DB::raw('preso_kits.data_final'));
                        })
                        ->get();
                     
        return view('admin.preso_kit.index', compact('params', 'data'));
    }

    public function trocarKit($id)
    {
        $this->params['subtitulo'] = 'Trocar Kit';
        $this->params['arvore'] = [
            [
                'url' => 'admin/preso_kit',
                'titulo' => 'Controle de Kit'
            ],
            [
                'url' => '',
                'titulo' => 'Trocar Kit'
            ]
        ];
        $params = $this->params;

        $data = $this->preso_kit->find($id);

        return view('admin.preso_kit.trocarkit', compact('params', 'data'));
    }

    public function liberar(Request $request, $id)
    {
        $dataForm['data_final']  = Carbon::now();

        if ($this->preso_kit->find($id)->update($dataForm)) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao editar.']);
        }
    }


    public function atribuirKit($preso_id)
    {
        $this->params['subtitulo'] = 'Atribuir Kit';
        $this->params['arvore'] = [
            [
                'url' => 'admin/preso_kit',
                'titulo' => 'Controle de Kit'
            ],
            [
                'url' => '',
                'titulo' => 'Atribuir Kit'
            ]
        ];

        $params = $this->params;

        $data = $this->preso->find($preso_id);

        return view('admin.preso_kit.atribuir', compact('params', 'data'));
    } 

    public function atribuir(Request $request, $preso_id)
    {
        $dataForm = $request->only('kit');

       
        $preso_kit = $this->preso_kit->where('kit',$dataForm['kit'])->where('data_final',null)->first();
        
        $data['preso_id'] = $preso_id;
        $data['data_inicial'] = Carbon::now();
        $data['kit'] = $dataForm['kit'];
        
        if($preso_kit != null){
          
            if ($this->preso_kit->find($preso_kit->id)->update(['data_final' => Carbon::now()])) {
                
                if($this->preso_kit->create($data)){
                    return redirect()->route($this->params['main_route'] . '.index');
                }else{
                    return redirect()->route($this->params['main_route'] . '.atribuir')->withErrors(['Falha ao atribuir.']);
                }

            } else {
                return redirect()->route($this->params['main_route'] . '.atribuir')->withErrors(['Falha ao atribuir.']);
            }
        }else{
            if ($this->preso_kit->create($data)) {
                return redirect()->route($this->params['main_route'] . '.index');
            } else {
                return redirect()->route($this->params['main_route'] . '.atribuir')->withErrors(['Falha ao atribuir.']);
            }
        }
    
    }
}
