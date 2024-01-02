<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setor\SetorRequest;
use App\Models\Setor;
use Illuminate\Http\Request;

class SetorController extends Controller
{
    
    public function __construct(Setor $setores)
    {
        
        $this->setor = $setores;
        // Default values
        $this->params['titulo']='Setor';
        $this->params['main_route']='admin.setor';

    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Setor Cadastrados';
        $this->params['arvore'][0] = [
                     'url' => 'admin/setor',
                     'titulo' => 'Setor'
        ];
 
        $params = $this->params;
        $data = $this->setor->select()->get();
        return view('admin.setor.index',compact('params','data'));

    }

    public function create()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Cadastrar Setores';
        $this->params['arvore']=[
           [
               'url' => 'admin/setor',
               'titulo' => 'Setor'
           ],
           [
               'url' => '',
               'titulo' => 'Cadastrar'
           ]];
       $params = $this->params;
            
       $preload = null;
       return view('admin.setor.create',compact('params','preload'));
    }

    public function store(SetorRequest $request)
    {
        $dataForm  = $request->all();

        $insert = $this->setor->create($dataForm);
        if($insert){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao fazer Inserir.']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->params['subtitulo']='Editar Setor';
        $this->params['arvore']=[
           [
               'url' => 'admin/setores',
               'titulo' => 'Galerias'
           ],
           [
               'url' => '',
               'titulo' => 'Editar'
           ]];
       $params = $this->params;
       $data = $this->setor->find($id);

       return view('admin.setor.create',compact('params', 'data'));
    }

   
    public function update(Request $request, $id)
    {
        $dataForm  = $request->all();

        if(! isset($dataForm["atendimento_online"])){
            $dataForm["atendimento_online"] = 0;
        }

        if($this->setor->find($id)->update($dataForm)){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao editar.']);
        }
    }

   
}
