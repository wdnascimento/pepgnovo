<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BaixaMaterial\BaixaMaterialInsertRequest;
use App\Models\BaixaMaterial;
use App\Models\Estoque;
use App\Models\Preso;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaixaMaterialController extends Controller
{

    private $params = [];
    private $produto;
    private $baixa_material;
    private $estoque;
    private $presos;


    public function __construct(Preso $presos, Produto $produtos, Estoque $estoques, BaixaMaterial $baixa_materials)
    {
        $this->baixa_material = $baixa_materials;
        $this->produto = $produtos;
        $this->estoque = $estoques;
        $this->presos = $presos;
        // dd($this->presos->where('prontuario','363216'));

        // Default values
        $this->params['titulo'] = 'Entrega Pertence Cubículo/Cela';
        $this->params['main_route'] = 'admin.baixa_material';
    }

    public function index(Request $request)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Baixa de Material Cubículo';
        $this->params['arvore'][0] = [
            'url' => 'admin/baixa_material',
            'titulo' => 'Baixa de Material Cubículo'
        ];

        /* id, produto_id, quantidade, motivo, cadastrado_por, data_cadastro, created_at, updated_at */

        $params = $this->params;

        $data = $this->baixa_material
            ->select(DB::raw('produtos.id as produto_id, 
            presos.nome as nome_preso, 
            produtos.descricao as desc_produto, 
            baixa_materials.id, 
            baixa_materials.quantidade, 
            baixa_materials.cadastrado_por, 
            DATE_FORMAT(baixa_materials.data_cadastro,"%d/%m/%Y") AS data_cadastro '))
            ->join('produtos', 'produtos.id', 'produto_id')
            ->join('presos', 'presos.id', 'baixa_materials.preso_id')
            ->orderby('baixa_materials.id')
            ->paginate(30);

        return view('admin.baixa_material.index', compact('params', 'data'));
    }

    public function create()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastrar Entrega do Pertence ao Preso';
        $this->params['arvore'] = [
            [
                'url' => 'admin/baixa',
                'titulo' => 'Baixa'
            ],
            [
                'url' => '',
                'titulo' => 'Cadastrar'
            ]
        ];
        $params = $this->params;

        $preload['produtos'] = $this->produto->orderBy('descricao')->get()->pluck('descricao', 'id');
        return view('admin.baixa_material.create', compact('params', 'preload'));
    }

    public function store(BaixaMaterialInsertRequest $request)
    {
        DB::beginTransaction();

        $dataForm  = $request->all();
        $dataForm['cadastrado_por'] = Auth::user()->email;
        $dataForm['data_cadastro'] = date('Y-m-d');

        // CASTING FOR DECIMAL NUMBERS
        $dataForm['quantidade'] = (float) str_replace(',', '.', str_replace('.', '', $dataForm['quantidade']));
        //  dd($dataForm);
        $insert = $this->baixa_material->create($dataForm);
        //  dd($insert);

        if ($insert){
            if (!$this->estoque->atualizarEstoque($dataForm['preso_id'],$dataForm['produto_id'], $dataForm['quantidade'], 0)) {
                return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao atualizar o estoque. [Saldo Insuficiente]']);
                DB::rollBack();
            }
            DB::commit();
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            DB::rollback();
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
        }
    }

    public function show($id)
    {
        $this->params['subtitulo'] = 'Visualizar Baixa';
        $this->params['arvore'] = [
            [
                'url' => 'admin/baixa_material',
                'titulo' => 'Entrega Cúbiculo'
            ],
            [
                'url' => '',
                'titulo' => 'Visualizar'
            ]
        ];
        $params = $this->params;

        $data = $this->baixa_material->find($id);

        $preload['produtos'] = $this->produto->orderBy('descricao')->get()->pluck('descricao', 'id');
        return view('admin.baixa_material.show', compact('params', 'data', 'preload'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $data = $this->baixa_material->find($id);
        if (!$this->estoque->atualizarEstoque($data['produto_id'], $data['preso_id'], $data['quantidade'], 1)) {
            return redirect()->route($this->params['main_route'] . '.show')->withErrors(['Falha ao atualizar o estoque. [2]']);
            DB::rollBack();
        }

        if (!$data->delete()) {
            DB::rollback();
            return back()->withErrors(['Falha ao deletar.']);
        }
        DB::commit();
        return redirect()->route($this->params['main_route'] . '.index');
    }
}
