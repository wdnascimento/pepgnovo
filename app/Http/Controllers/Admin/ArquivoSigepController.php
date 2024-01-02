<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArquivoSigep;
use App\Http\Requests\Admin\ArquivoSigep\ArquivoSigepRequest;
use App\Models\Cubiculo;
use App\Models\Galeria;
use App\Models\Preso;
use App\Models\PresoAlojamento;
use Carbon\Carbon;
use Auth;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class ArquivoSigepController extends Controller
{   
    public $params;
    public $atendimento;
    public $arquivo_sigep;
    public $preso_alojamento;
    public $preso;
    public $galeria;
    public $cubiculo;
    

    public function __construct(ArquivoSigep $arquivo_sigeps, Preso $presos, PresoAlojamento $presos_alojamentos, Galeria $galerias, Cubiculo $cubiculos)
    {

        $this->arquivo_sigep = $arquivo_sigeps;
        $this->preso = $presos;
        $this->preso_alojamento = $presos_alojamentos;
        $this->galeria = $galerias;
        $this->cubiculo = $cubiculos;
        // Default values
        $this->params['titulo'] = 'Arquivo Sigep';
        $this->params['main_route'] = 'admin.arquivo_sigep';
    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Arquivo Sigep Cadastrados';
        $this->params['arvore'][0] = [
            'url' => 'admin/arquivo_sigep',
            'titulo' => 'Arquivo Sigep'
        ];

        $params = $this->params;
        $data = $this->arquivo_sigep->orderBy('data_hora', 'desc')->limit(15)->get();
        return view('admin.arquivo_sigep.index', compact('params', 'data'));
    }

    public function create()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo'] = 'Cadastrar Arquivo Sigep';
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
        $params = $this->params;

        $preload = null;
        return view('admin.arquivo_sigep.create', compact('params', 'preload'));
    }

    public function store(ArquivoSigepRequest $request)
    {

        if ($request->file()) {
            $fileName = date('YmdHis') . '.' . $request->file->getClientOriginalExtension();
            $filePath = $request->file->storeAs('uploads', $fileName, 'public');

            //id, titulo, data_hora, importado, usuario,
            $data['titulo'] = $filePath;
            $data['data_hora'] = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
            $data['importado'] = 0;
            $data['usuario'] = Auth()->user()->email;

            $insert = $this->arquivo_sigep->create($data);
            if ($insert) {
                return redirect()->route($this->params['main_route'] . '.index');
            } else {
                return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao fazer Inserir.']);
            }
        }
    }


    public function import($id)
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

        $data = $this->arquivo_sigep->find($id);
        if ($data->importado == 0) {
            // galerias 
            $GALERIAS = $this->galeria->select(DB::raw('UPPER(titulo) as titulo'))->get()->toArray();

                $url = Storage::url($data->titulo);
                    $streamSSL = stream_context_create(array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false
                        )
                    ));

                    

                    $file_handle = fopen($url, 'r', false, $streamSSL);
                    $i=0;
                    while (!feof($file_handle)) {
                        if(!isset($csv)){
                            $csv = [];
                            $csv  = fgetcsv($file_handle, 0, ',');
                        }else{
                            $csv  = fgetcsv($file_handle, 0, ',');
                            $nome_prontuario = preg_split("/[\-]/", $csv[0]);
                            $prontuarios[] = trim($nome_prontuario[0]);
                            $tmp_presos[$i]['prontuario'] = trim($nome_prontuario[0]);
                            $tmp_presos[$i]['nome']             = trim($nome_prontuario[1]);
                            $tmp_presos[$i]['rg']               =  trim($csv[1]);
                            $tmp_presos[$i]['data_nascimento']  =  \Carbon\Carbon::parse(strtotime(trim($csv[2])))->format('Y-m-d');
                            $tmp_presos[$i]['mae']              =  trim($csv[3]);
                            $tmp_presos[$i]['artigos']           =  trim($csv[4]);
                            $tmp_presos[$i]['situacao']  =  trim($csv[5]);
                            $alojamento =  preg_split("/(\/\s)/", $csv[6]);
                            $tmp_presos[$i]['bloco']            =  trim($alojamento[0]);
                            $tmp_presos[$i]['galeria']          =  trim($alojamento[1]);
                            $tmp_presos[$i]['cubiculo']         =  trim($alojamento[2]);
                            $tmp_presos[$i]['origem']           =  trim($csv[7]);
                            $tmp_presos[$i]['data_prisao']      =  \Carbon\Carbon::parse(strtotime(trim($csv[8])))->format('Y-m-d');
                            $tmp_presos[$i]['data_depen']       =  \Carbon\Carbon::parse(strtotime(trim($csv[9])))->format('Y-m-d');
                            $tmp_presos[$i]['data_entrada']     =  \Carbon\Carbon::parse(strtotime(trim($csv[10])))->format('Y-m-d');
                            // VERIFICA SE A GALERIA EXISTE

                            $galerias = array_search(strtoupper($tmp_presos[$i]['galeria']), array_column($GALERIAS, 'titulo'));
                            if ($galerias !== false) {
                                // VERIFICA SE O PRESO ESTÁ CADASTRADO 

                                $presos = $this->preso->select('id')->where('prontuario', $tmp_presos[$i]['prontuario'])->first();

                                if ($presos) {
                                    $this->preso->find($presos["id"])->update($tmp_presos[$i]);
                                    $tmp_presos[$i]['id'] = $presos["id"];
                                } else {
                                    $result = $this->preso->create($tmp_presos[$i]);
                                    if ($result) {
                                        $tmp_presos[$i]['id'] = $result->id;
                                    }
                                }

                                // ALOJA O PRESO

                                $cubiculo_id =  $this->cubiculo->getCubiculoIdGaleriaCubiculo($tmp_presos[$i]['galeria'], $tmp_presos[$i]['cubiculo'])->first();

                                // LIMPA ALOJAMENTOS 
                                $alojamento = $this ->preso_alojamento
                                                    ->where('preso_id',$tmp_presos[$i]['id'])
                                                    ->where('data_saida',NULL)
                                                    ->where('cubiculo_id',$cubiculo_id["id"])
                                                    ->get();
                                                    //  dd($alojamento);
                                if($alojamento->isEmpty()){
                                    $alojamento = $this ->preso_alojamento
                                                ->where('preso_id',$tmp_presos[$i]['id'])
                                                ->where('data_saida',NULL)
                                                ->get();
                                    if($alojamento->isNotEmpty()){
                                        $result = $this->preso_alojamento
                                                        ->where('preso_id',$tmp_presos[$i]['id'])
                                                        ->where('data_saida',NULL)
                                                        ->update(['data_saida' => \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo'),
                                                                    'motivo' => 'Movimento Sistema']);
                                        if (! $result) {
                                            return redirect()->back()->withErrors(['Erro a zerar alojamento']);
                                        }
                                        $tmp_alojamento_preso = [];
                                        $tmp_alojamento_preso["preso_id"] = $tmp_presos[$i]['id'];
                                        $tmp_alojamento_preso["cubiculo_id"] =  $cubiculo_id["id"];
                                        $tmp_alojamento_preso["data_entrada"] = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
                                        $tmp_alojamento_preso["motivo"] ='';
                                        if (!$this->preso_alojamento->insert($tmp_alojamento_preso)) {
                                            return redirect()->back()->withErrors(['Erro ao criar novo alojamento']);
                                        }
                                    }else{
                                        $tmp_alojamento_preso = [];
                                        $tmp_alojamento_preso["preso_id"] = $tmp_presos[$i]['id'];
                                        $tmp_alojamento_preso["cubiculo_id"] =  $cubiculo_id["id"];
                                        $tmp_alojamento_preso["data_entrada"] = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
                                        $tmp_alojamento_preso["motivo"] ='';
                                        if (!$this->preso_alojamento->insert($tmp_alojamento_preso)) {
                                            return redirect()->back()->withErrors(['Erro ao criar novo alojamento']);
                                        }
                                    }
                                }
                            }
                            $i++;
                        }
                    }
                    fclose($file_handle);
        } else {
            return redirect()->back()->withErrors(['Erro ao importar, Arquivo já importado anteriormente.']);
        }
        if (!$data->update(['importado' => 1])) {
            return redirect()->back()->withErrors(['Erro modificar status da importação.']);
        }
        return redirect()->route($this->params['main_route'] . '.index');
    }

    public function update(ArquivoSigepRequest $request, $id)
    {
        $data = $this->arquivo_sigep->find($id);

        $dataForm  = $request->all();

        if ($data->update($dataForm)) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao editar.']);
        }
    }

    public function destroy($id)
    {
        $data = $this->arquivo_sigep->find($id);

        if ($data->delete()) {
            return redirect()->route($this->params['main_route'] . '.index');
        } else {
            return redirect()->route($this->params['main_route'] . '.create')->withErrors(['Falha ao deletar.']);
        }
    }
}
