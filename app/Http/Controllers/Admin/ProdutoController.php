<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Produto\ProdutoRequest;
use App\Models\TableCodes;
use App\Models\Produto;
use Illuminate\Http\Request;


class ProdutoController extends Controller
{
    public function __construct(Produto $produtos)
    {

        $this->produto = $produtos;

        // Default values
        $this->params['titulo'] = 'Produto';
        $this->params['main_route'] = 'admin.produto';
    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastro de Produtos';
        $this->params['arvore'][0] = [
            'url' => 'admin/produto',
            'titulo' => 'Produtos'
        ];

        $params = $this->params;
        $data = $this->produto->select()->get();
        return view('admin.produto.index', compact('params', 'data'));
    }

    public function create(TableCodes $codes)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastrar Produtos';
        $this->params['arvore'] = [
            [
                'url' => 'admin/produto',
                'titulo' => 'Produto'
            ],
            [
                'url' => '',
                'titulo' => 'Cadastrar'
            ]
        ];
        $params = $this->params;

        $preload['categoria'] = $codes->select(6);
        $preload['controlado_almox'] = $codes->select(7);
        $preload['unidade_medida'] = $codes->select(8);

        return view('admin.produto.create', compact('params', 'preload'));
    }

    public function store(ProdutoRequest $request)
    {
        $dataForm  = $request->all();

        $insert = $this->produto->create($dataForm);
        if ($insert) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
        }
    }

    public function show($id, TableCodes $codes)
    {
        $this->params['subtitulo'] = 'Deletar Produto';
        $this->params['arvore'] = [
            [
                'url' => 'admin/produto',
                'titulo' => 'Produtos'
            ],
            [
                'url' => '',
                'titulo' => 'Editar'
            ]
        ];
        $params = $this->params;
        $data = $this->produto->find($id);
        
        $preload['categoria'] = $codes->select(6);
        $preload['controlado_almox'] = $codes->select(7);
        $preload['unidade_medida'] = $codes->select(8);

        return view('admin.produto.show', compact('params', 'data', 'preload'));
    }

    public function edit($id, TableCodes $codes)
    {
        $this->params['subtitulo'] = 'Editar Produto';
        $this->params['arvore'] = [
            [
                'url' => 'admin/produto',
                'titulo' => 'Produto'
            ],
            [
                'url' => '',
                'titulo' => 'Editar'
            ]
        ];
        $params = $this->params;

        $data = $this->produto->find($id);

        $preload['categoria'] = $codes->select(6);
        $preload['controlado_almox'] = $codes->select(7);
        $preload['unidade_medida'] = $codes->select(8);

        return view('admin.produto.create', compact('params', 'data', 'preload'));
    }


    public function update(Request $request, $id)
    {
        $dataForm  = $request->all();

        if ($this->produto->find($id)->update($dataForm)) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao editar.']);
        }
    }

    public function destroy($id)
    {
        $data = $this->produto->find($id);

        if ($data->delete()) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao deletar.']);
        }
    }
}
