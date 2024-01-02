<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pessoa\PessoaRequest;
use App\Models\Pessoa;
use App\Models\TableCodes;

use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function __construct(Pessoa $pessoas)
    {

        $this->pessoa = $pessoas;

        // Default values
        $this->params['titulo'] = 'Pessoas';
        $this->params['main_route'] = 'admin.pessoa';
    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastro de Pessoas';
        $this->params['arvore'][0] = [
            'url' => 'admin/pessoa ',
            'titulo' => 'Cadastro Pessoas'
        ];

        $params = $this->params;
        $data = $this->pessoa->get();
        return view('admin.pessoa.index', compact('params', 'data'));
    }

    public function create(TableCodes $codes)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastrar Pessoas';
        $this->params['arvore'] = [
            [
                'url' => 'admin/pessoa',
                'titulo' => 'Cadastro de Pessoas'
            ],
            [
                'url' => '',
                'titulo' => 'Cadastrar'
            ]
        ];
        $params = $this->params;

        $preload['tipo'] = $codes->select(4);
        return view('admin.pessoa.create', compact('params', 'preload'));
    }

    public function store(PessoaRequest $request)
    {
        $dataForm  = $request->all();

        $insert = $this->pessoa->create($dataForm);
        if ($insert) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
        }
    }

    public function show($id, TableCodes $codes)
    {
        $this->params['subtitulo'] = 'Deletar Pessoas';
        $this->params['arvore'] = [
            [
                'url' => 'admin/pessoa',
                'titulo' => 'Pessoas'
            ],
            [
                'url' => '',
                'titulo' => 'Editar'
            ]
        ];
        $params = $this->params;
        $data = $this->pessoa->find($id);
        $preload['tipo'] = $codes->select(4);

        return view('admin.pessoa.show', compact('params', 'data', 'preload'));
    }

    public function edit($id, TableCodes $codes)
    {
        $this->params['subtitulo'] = 'Editar Cadastro Pessoas';
        $this->params['arvore'] = [
            [
                'url' => 'admin/pessoa',
                'titulo' => 'Pessoas'
            ],
            [
                'url' => '',
                'titulo' => 'Editar'
            ]
        ];
        $params = $this->params;

        $data = $this->pessoa->find($id);

        $preload['tipo'] = $codes->select(4);
        return view('admin.pessoa.create', compact('params', 'data', 'preload'));
    }


    public function update(Request $request, $id)
    {
        $dataForm  = $request->all();

        // if(! isset($dataForm["atendimento_online"])){
        //     $dataForm["atendimento_online"] = 0;
        // }

        if ($this->pessoa->find($id)->update($dataForm)) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao editar.']);
        }
    }

    public function destroy($id)
    {
        $data = $this->pessoa->find($id);

        if ($data->delete()) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao deletar.']);
        }
    }
}
