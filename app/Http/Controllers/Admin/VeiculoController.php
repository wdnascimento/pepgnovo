<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Veiculo\VeiculoRequest;
use App\Models\Setor;
use App\Models\TableCodes;
use App\Models\Veiculo;
use Illuminate\Http\Request;


class VeiculoController extends Controller
{
    public function __construct(Veiculo $veiculos)
    {
        
        $this->veiculo = $veiculos;
        
        // Default values
        $this->params['titulo']='Veiculo';
        $this->params['main_route']='admin.veiculo';

    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Cadastro de Veiculos';
        $this->params['arvore'][0] = [
                     'url' => 'admin/veiculo',
                     'titulo' => 'Veiculos'
        ];
 
        $params = $this->params;
        $data = $this->veiculo->select()->get();
        return view('admin.veiculo.index',compact('params','data'));

    }

    public function create(TableCodes $codes)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Cadastrar Veiculos';
        $this->params['arvore']=[
           [
               'url' => 'admin/veiculo',
               'titulo' => 'Veiculo'
           ],
           [
               'url' => '',
               'titulo' => 'Cadastrar'
           ]];
       $params = $this->params;
            
       $preload['tipo'] = $codes->select(2);
       return view('admin.veiculo.create',compact('params','preload'));
    }

    public function store(VeiculoRequest $request)
    {
        $dataForm  = $request->all();

        $insert = $this->veiculo->create($dataForm);
        if($insert){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao fazer Inserir.']);
        }
    }

    public function show($id, TableCodes $codes)
    {
        $this->params['subtitulo']='Deletar Veiculo';
        $this->params['arvore']=[
           [
               'url' => 'admin/veiculos',
               'titulo' => 'Veiculos'
           ],
           [
               'url' => '',
               'titulo' => 'Editar'
           ]];
       $params = $this->params;
       $data = $this->veiculo->find($id);
       $preload['tipo'] = $codes->select(2);

       return view('admin.veiculo.show',compact('params', 'data','preload'));
    }

    public function edit($id, TableCodes $codes)
    {
        $this->params['subtitulo']='Editar Veiculo';
        $this->params['arvore']=[
           [
               'url' => 'admin/veiculos',
               'titulo' => 'Galerias'
           ],
           [
               'url' => '',
               'titulo' => 'Editar'
           ]];
       $params = $this->params;
       
       $data = $this->veiculo->find($id);

       $preload['tipo'] = $codes->select(2);
       return view('admin.veiculo.create',compact('params', 'data','preload'));
    }

   
    public function update(Request $request, $id)
    {
        $dataForm  = $request->all();

        if(! isset($dataForm["atendimento_online"])){
            $dataForm["atendimento_online"] = 0;
        }

        if($this->veiculo->find($id)->update($dataForm)){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao editar.']);
        }
    }

    public function destroy($id)
    {
        $data = $this->veiculo->find($id);

        if($data->delete()){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao deletar.']);
        }
    }

}
