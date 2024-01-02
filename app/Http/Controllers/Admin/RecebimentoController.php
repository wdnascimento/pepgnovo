<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Recebimento\RecebimentoInsertRequest;
use App\Http\Requests\Admin\Recebimento\RecebimentoUpdateRequest;
use App\Models\Estoque;
use App\Models\PresoFamiliares;
use App\Models\Produto;
use App\Models\Recebimento;
use App\Models\TableCodes;
use App\Models\RecebimentoItens;
use App\Models\RecebimentoStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecebimentoController extends Controller
{
    private $params = [];
    private $recebimento;
    private $produto;
    private $recebimento_itens;
    private $recebimento_status;
    private $estoque;

    public function __construct(Recebimento $recebimentos, Produto $produtos, RecebimentoItens $recebimento_itens, RecebimentoStatus $recebimento_status)
    {

        $this->recebimento = $recebimentos;
        $this->produto = $produtos;
        $this->recebimento_itens = $recebimento_itens;
        $this->recebimento_status = $recebimento_status;
        $this->estoque = new Estoque();
            
        // Default values
        $this->params['titulo'] = 'Recebimento de Pertences';
        $this->params['main_route'] = 'admin.recebimento';
    }

    public function index(Request $request)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastro de Recebimento de Pertences';
        $this->params['arvore'][0] = [
            'url' => 'admin/recebimento',
            'titulo' => 'Cadastro Recebimento de Pertences'
        ];

        $params = $this->params;
        $data = $this->recebimento->select('preso_familiares.*', 'recebimentos.*', 'presos.nome as nome_preso')
            ->join('preso_familiares', 'preso_familiares.id', 'recebimentos.preso_familiar_id')
            ->join('presos', 'presos.id', 'recebimentos.preso_id')
            ->get();
        return view('admin.recebimento.index', compact('params', 'data'));
    }

    public function create(TableCodes $codes)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastrar Pertences';
        $this->params['arvore'] = [
            [
                'url' => 'admin/recebimento',
                'titulo' => 'Cadastro de Pertences'
            ],
            [
                'url' => '',
                'titulo' => 'Cadastrar'
            ]
        ];
        $params = $this->params;

        $preload['produtos'] = $this->produto->orderBy('descricao')->get()->pluck('descricao', 'id');
        $preload['categoria'] = $codes->select(6);
        $preload['controlado_almox'] = $codes->select(7);
        $preload['unidade_medida'] = $codes->select(8);

        return view('admin.recebimento.create', compact('params', 'preload'));
    }

    public function store(RecebimentoInsertRequest $request)
    {
        DB::beginTransaction();

        $dataForm = $request->only(['preso_id', 'preso_familiar_id']);
        $dataForm['status'] = 1;
        $dataForm['cadastrado_por'] = Auth::user()->email;
        $dataForm['data_hora'] = \Carbon\Carbon::now();

        $insert = $this->recebimento->create($dataForm);
        if ($insert) {
            $dataFormItens  = $request->only(['produto_id', 'quantidade']);
            $recebimento_id = $insert->id;
            foreach ($dataFormItens['produto_id'] as $i => $v) {
                $data['recebimento_id'] = $recebimento_id;
                $data['produto_id'] = $dataFormItens['produto_id'][$i];
                $data['quantidade'] = (float) str_replace(',', '.', str_replace('.', '', $dataFormItens['quantidade'][$i]));

                if (!$this->recebimento_itens->create($data)) {
                    DB::rollBack();
                    return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao Inserir Itens.']);
                }
                if (!$this->estoque->atualizarEstoque($dataForm['preso_id'],$data['produto_id'], $data['quantidade'], 1)) {
                    return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao atualizar o estoque.']);
                    DB::rollBack();
                }
            }
        }
        // id, recebimento_id, inicio, fim, status, cadastrado_por, created_at, updated_at
        $dataStatus['recebimento_id'] =  $recebimento_id;
        $dataStatus['inicio'] = \Carbon\Carbon::now();
        $dataStatus['fim'] = null;
        $dataStatus['status'] = 1;
        $dataStatus['cadastrado_por'] = Auth::user()->name;
        if (!$this->recebimento_status->create($dataStatus)) {
            DB::rollBack();
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao Inserir Status.']);
        }
        DB::commit();
        return redirect()->route($this->params['main_route'] . '.index');
    }

    public function show($id, TableCodes $codes)
    {
        $this->params['subtitulo'] = 'Deletar Orçamento';
        $this->params['arvore'] = [
            [
                'url' => 'admin/recebimento',
                'titulo' => 'Recebimento'
            ],
            [
                'url' => '',
                'titulo' => 'Deletar'
            ]
        ];
        $params = $this->params;

        $data = $this->recebimento->find($id);
        $preload['codes'] = $codes->select(2);
        return view('admin.recebimento.show', compact('params', 'data', 'preload'));
    }

    public function edit($id, TableCodes $codes)
    {
        $this->params['subtitulo'] = 'Editar Orçamento';
        $this->params['arvore'] = [
            [
                'url' => 'admin/recebimento',
                'titulo' => 'Recebimento'
            ],
            [
                'url' => '',
                'titulo' => 'Editar'
            ]
        ];
        $params = $this->params;
        $data = $this->recebimento->getRecebimento($id);
        $preload['codes'] = $codes->select(2);
        $preload['produtos'] = $this->produto->orderBy('descricao')->get()->pluck('descricao', 'id');
        return view('admin.recebimento.create', compact('params', 'data', 'preload'));
    }

    public function update(RecebimentoUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        $dataForm = $request->all();
        $update = $this->recebimento->find($id)->update($dataForm);
        if ($update) {
            $delete = $this->recebimento_itens->where('recebimento_id', $id)->delete();
            if ($delete) {
                $dataFormItens  = $request->all();

                foreach ($dataFormItens['produto_id'] as $i => $v) {
                    /*
                        id, recebimento_id, produto_id, quantidade, created_at, updated_at
                    */
                    $data['recebimento_id'] = $id;
                    $data['produto_id'] = $dataFormItens['produto_id'][$i];
                    $data['quantidade'] = (float) str_replace(',', '.', str_replace('.', '', $dataFormItens['quantidade'][$i]));
                    if (!$this->recebimento_itens->create($data)) {
                        return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
                        DB::rollBack();
                    }
                }
                DB::commit();
                return redirect()->route($this->params['main_route'] . '.index');
            } else {
                DB::rollback();
                return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao atualizar itens do pedido.']);
            }
        } else {
            DB::rollback();
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
        }
    }
}
