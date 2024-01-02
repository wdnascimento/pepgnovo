<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Preso;
use App\Models\PresoFamiliares;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Recebimento;
use App\Models\RecebimentoItens;
use App\Models\RecebimentoStatus;
use App\Models\TableCodes;
use App\Models\Triagem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\Cloner\Data;

class TriagemController extends Controller
{
    private $params = [];
    private $recebimento;
    private $produto;
    private $recebimento_itens;
    private $recebimento_status;
    private $preso;
    private $presofamiliares;

    public function __construct(Produto $produtos, Recebimento $recebimentos, RecebimentoItens $recebimentoItens, RecebimentoStatus $recebimento_status, Preso $preso, PresoFamiliares $presoFamiliares)
    {
        $this->produto = $produtos;
        $this->recebimento = $recebimentos;
        $this->recebimento_itens = $recebimentoItens;
        $this->recebimento_status = $recebimento_status;
        $this->preso = $preso;

        // Default values
        $this->params['titulo'] = 'Triagem';
        $this->params['main_route'] = 'admin.triagem';
    }


    public function index(Request $request)
    {
        // Parâmetros do cabeçalho
        $this->params['subtitulo'] = 'Triagem';
        $this->params['arvore'][0] = [
            'url' => 'admin/triagem',
            'titulo' => 'Triagem'
        ];

        $params = $this->params;
        // Recebendo o resultado da query e gravando na variavel $data
        $data = $this->recebimento
            ->select(
                'recebimentos.id',
                'recebimentos.data_hora as data_recebimento',
                'presos.nome as nome_preso',
                'rs.status',
                DB::raw('(select t.descricao from table_codes t where t.pai=9 and t.valor=rs.status) as desc_status')
            )
            ->join('preso_familiares', 'recebimentos.preso_familiar_id', '=', 'preso_familiares.id')
            ->join('presos', 'preso_familiares.preso_id', '=', 'presos.id')
            ->join('recebimento_status as rs', function ($join) {
                $join->on('rs.recebimento_id', 'recebimentos.id')
                    ->where('rs.fim', NULL);
            })
            ->get();
          

        return view('admin.triagem.index', compact('params', 'data'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Triagem $triagem)
    {
        //
    }


    public function edit($id, Triagem $triagem, TableCodes $codes)
    {
        $this->params['subtitulo'] = 'Editar Triagem';
        $this->params['arvore'] = [
            [
                'url' => 'admin/triagem',
                'titulo' => 'Editar Triagem'
            ],
            [
                'url' => '',
                'titulo' => 'Editar Triagem'
            ]
        ];
        $params = $this->params;

        $data = $this->recebimento->getRecebimento($id);

        
      
        // TableCodes "STATUS DO RECEBIMENTO"
        $preload['produtos'] = $this->produto->orderBy('descricao')->get()->pluck('descricao','id');
        $preload['status'] = $codes->selectByValor(9);      

        
        return view('admin.triagem.create', compact('params', 'data', 'preload'));
    }


    public function update(Request $request, Triagem $triagem, Preso $preso)
    {
        DB::beginTransaction();


        $dataForm  = $request->all();
        $status = $this->recebimento_status->where('recebimento_id', $dataForm['recebimento_id'])->where('fim', NULL)->first();
      
        if (($status != null ) && (intval($status->status) != intval($dataForm['status'])) ){
            if(intval($status->status) >= intval($dataForm['status'])){
                DB::rollback();
                return Redirect::back()->withErrors(['Falha ao alterar o status! Status menor ou igual ao anterior.']);
            }
            if(!$this->recebimento_status->find($status->id)->update(['fim' => \Carbon\Carbon::now()])){
                DB::rollback();
                return Redirect::back()->withErrors(['Falha ao alterar o status anterior!.']);
            }

            
            if (intval($dataForm['status']) === 3) {
                $baixa_estoque = $request->only('baixa_estoque');
                if (!$this->recebimento->lancarBaixaPedido($dataForm['recebimento_id'],$baixa_estoque)) {
                    DB::rollback();
                    return Redirect::back()->withErrors(['Falha ao baixar estoque do pedido!']);
                }
            }

            $dataForm['inicio'] = \Carbon\Carbon::now();
            $dataForm['cadastrado_por'] = Auth::user()->name;
            $create = $this->recebimento_status->create($dataForm);

            if (!$create) {
                DB::rollback();
                return Redirect::back()->withErrors(['Falha ao alterar o status!']);
            }

            DB::commit();
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            DB::rollback();
            return Redirect::back()->withErrors(['Falha ao alterar o status!']);
        }
    }

  
}
