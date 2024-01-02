<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ControleAcesso\ControleAcessoRequest;
use App\Models\TableCodes;
use App\Models\ControleAcesso;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;


class ControleAcessoController extends Controller
{
    public function __construct(ControleAcesso $controle_acessos)
    {
        
        $this->controle_acesso = $controle_acessos;
        
        // Default values
        $this->params['titulo']='Controle de Acesso da Portaria';
        $this->params['main_route']='admin.controleacesso';

    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Controle de Acesso da Portaria';
        $this->params['arvore'][0] = [
                     'url' => 'admin/controleacesso',
                     'titulo' => 'Controle de Acessos'
        ];
 
        $params = $this->params;
        $data = $this->controle_acesso->with('pessoa')->with('veiculo')->select()->get();
        return view('admin.controleacesso.index',compact('params','data'));

    }

    public function create(TableCodes $codes)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Cadastrar Controle de Acessos';
        $this->params['arvore']=[
           [
               'url' => 'admin/controleacesso',
               'titulo' => 'Controle de Acesso'
           ],
           [
               'url' => '',
               'titulo' => 'Cadastrar'
           ]];
       $params = $this->params;
            
       $preload['tipo'] = $codes->select(5);
       return view('admin.controleacesso.create',compact('params','preload'));
    }

    public function store(ControleAcessoRequest $request)
    {
        $dataForm  = $request->all();

        $format = 'Y-m-!d H:i:s';
                
        $dataForm['data_entrada'] = Carbon::parse($dataForm['data_entrada'])->format('Y-m-d H:i:s');
        
        $insert = $this->controle_acesso->create($dataForm);
        if($insert){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao fazer Inserir.']);
        }
    }

    public function show($id, TableCodes $codes)
    {
        $this->params['subtitulo']='Atualizar Controle de Acesso';
        $this->params['arvore']=[
           [
               'url' => 'admin/controle_acessos',
               'titulo' => 'Controle de Acessos'
           ],
           [
               'url' => '',
               'titulo' => 'Editar'
           ]];
       $params = $this->params;
       $data = $this->controle_acesso->with('pessoa')->with('veiculo')->find($id);
       $preload['tipo'] = $codes->select(5);
            

       return view('admin.controleacesso.show',compact('params', 'data','preload'));
    }

    public function edit($id, TableCodes $codes)
    {
        $this->params['subtitulo']='Editar Controle de Acesso';
        $this->params['arvore']=[
           [
               'url' => 'admin/controleacesso',
               'titulo' => 'Controles'
           ],
           [
               'url' => '',
               'titulo' => 'Editar'
           ]];
       $params = $this->params;
       
       $data = $this->controle_acesso->with('pessoa')->with('veiculo')->find($id);
            
       $preload['tipo'] = $codes->select(5);
       return view('admin.controleacesso.create',compact('params', 'data','preload'));
    }

    public function exit($id, TableCodes $codes)
    {
        $this->params['subtitulo']='Editar Controle de Acesso';
        $this->params['arvore']=[
           [
               'url' => 'admin/controleacesso',
               'titulo' => 'Controles'
           ],
           [
               'url' => '',
               'titulo' => 'Editar'
           ]];
       $params = $this->params;
       
       $data = $this->controle_acesso->find($id);

       $preload['tipo'] = $codes->select(5);
       return view('admin.controleacesso.exit',compact('params', 'data','preload'));
    }

    public function update(Request $request, $id)
    {
        $dataForm  = $request->all();
       
        $dataForm['data_entrada'] = Carbon::parse($dataForm['data_entrada'])->format('Y-m-d H:i:s'); 
       
        if($this->controle_acesso->find($id)->update($dataForm)){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao editar.']);
        }
    }

   
    public function updateexit(Request $request, $id)
    {
        $dataForm  = $request->only('data_saida');
        
        $dataForm['data_saida'] = Carbon::parse($dataForm['data_saida'])->format('Y-m-d H:i:s'); 

        if($this->controle_acesso->find($id)->update($dataForm)){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao editar.']);
        }
    }

    public function destroy($id)
    {
        $data = $this->controle_acesso->find($id);

        if($data->delete()){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao deletar.']);
        }
    }

}
