<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArquivoVisitaSigep\ArquivoVisitaSigepRequest;
use App\Models\ArquivoVisitaSigep;
use App\Models\Preso;
use App\Models\PresoFamiliares;
use Illuminate\Support\Facades\Storage;

class ArquivoVisitaSigepController extends Controller
{

    public $params;
    public $atendimento;
    public $arquivo_visita_sigep;
    public $preso;

    public function __construct(ArquivoVisitaSigep $arquivo_visita_sigeps, Preso $presos)
    {

        $this->arquivo_visita_sigep = $arquivo_visita_sigeps;
        $this->preso = $presos;
        // Default values
        $this->params['titulo'] = 'Arquivo Visita Sigep';
        $this->params['main_route'] = 'admin.arquivo_visita_sigep';
    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Arquivo Visita Sigep Cadastrados';
        $this->params['arvore'][0] = [
            'url' => 'admin/arquivo_visita_sigep',
            'titulo' => 'Arquivo Visita Sigep'
        ];

        $params = $this->params;
        $data = $this->arquivo_visita_sigep->orderBy('data_hora', 'desc')->limit(15)->get();
        return view('admin.arquivo_visita_sigep.index', compact('params', 'data'));
    }

    public function create()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastrar Arquivo Visita Sigep';
        $this->params['arvore'] = [
            [
                'url' => 'admin/arquivo_visita_sigep',
                'titulo' => 'Arquivo Visita Sigep'
            ],
            [
                'url' => '',
                'titulo' => 'Cadastrar'
            ]
        ];
        $params = $this->params;

        $preload = null;
        return view('admin.arquivo_visita_sigep.create', compact('params', 'preload'));
    }

    public function store(ArquivoVisitaSigepRequest $request)
    {

        if ($request->file()) {
            $fileName = date('YmdHis') . '.' . $request->file->getClientOriginalExtension();
            $filePath = $request->file->storeAs('uploads', $fileName, 'public');

            //id, titulo, data_hora, importado, usuario,
            $data['titulo'] = $filePath;
            $data['data_hora'] = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
            $data['importado'] = 0;
            $data['usuario'] = Auth()->user()->email;

            $insert = $this->arquivo_visita_sigep->create($data);
            if ($insert) {

                return redirect()->route($this->params['main_route'] . '.index');
            } else {
                return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
            }
        }
    }



    public function import($id , PresoFamiliares $preso_familiares)
    {
        $this->params['subtitulo'] = 'Importar Arquivo Sigep';
        $this->params['arvore'] = [
            [
                'url' => 'admin/arquivo_sigep',
                'titulo' => 'Arquivo Sigep'
            ],
            [
                'url' => '',
                'titulo' => 'Cadastrar'
            ]
        ];

        $data = $this->arquivo_visita_sigep->find($id);
       
        if ($data->importado == 0) {

            // GET NO ARQUIVO

            $url = Storage::url($data->titulo);
            
            // PARAMETRIZAÇÃO

            $streamSSL = stream_context_create(array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false
                )
            ));

            // INICIALIZANDO VARIÁVEIS

            $csv = [];
            
            // MANIPULANDO ARQUIVO
            $file_handle = fopen($url, 'r', false, $streamSSL);

            while (!feof($file_handle)) {
                $csv[] = fgetcsv($file_handle, 0, ';');
            }
            fclose($file_handle);

            // EXTRAINDO TÍTULOS
            array_shift($csv);

            foreach ($csv as $i => $v) {
                $tmp_presos[$i]['preso_id'] = $this->preso->getIdFromProntuario($v[0]);
                $tmp_presos[$i]['credencial'] = trim($v[5]);
                $tmp_presos[$i]['validade']   =  \Carbon\Carbon::parse(strtotime(trim($v[6])))->format('Y-m-d');
                $tmp_presos[$i]['tipo'] = trim($v[7]);
                $tmp_presos[$i]['nome'] = trim($v[8]);
                $tmp_presos[$i]['afinidade'] = trim($v[9]);
                $tmp_presos[$i]['status'] = trim($v[10]);
                $tmp_presos[$i]['data_nascimento']  =  \Carbon\Carbon::parse(strtotime(trim($v[15])))->format('Y-m-d');
                $tmp_presos[$i]['rg'] = trim($v[16]);
                $tmp_presos[$i]['cpf'] = trim($v[17]);
                //  dd($csv);
                if($tmp_presos[$i]['preso_id']){ // TESTA SE EXISTE O PRESO                
               
                    if($tmp_familiar=$preso_familiares->where('credencial', $tmp_presos[$i]['credencial'])->first()){
                        
                        $update = $preso_familiares->find($tmp_familiar->id)->update($tmp_presos[$i]);
                    
                        if (!$update) {
                            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
                        }     
                    }else{
                        $insert = $preso_familiares->create($tmp_presos[$i]);
                    
                        if (!$insert) {
                            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
                        }
                        
                    }  
                }

            } 
            if (!$data->update(['importado' => 1])) {
               
                return redirect()->back()->withErrors(['Erro modificar status da importação.']);
            } 
        }
         return redirect()->route($this->params['main_route'].'.index');
    }

    public function update(ArquivoVisitaSigepRequest $request, $id)
    {
        $data = $this->arquivo_visita_sigep->find($id);

        $dataForm  = $request->all();

        if ($data->update($dataForm)) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao editar.']);
        }
    }

    public function destroy($id)
    {
        $data = $this->arquivo_visita_sigep->find($id);

        if ($data->delete()) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao deletar.']);
        }
    }
}
