<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Atendimento\AtendimentoRequest;
use App\Models\Preso;
use App\Models\Atendimento;
use App\Models\PresoAlojamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class PresoController extends Controller
{
    public $kit;
    public $preso;

    public function index(Preso $presos, $prontuario)
    {
        return $presos->where('prontuario', $prontuario)->first();
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'audio' => 'required|mimes:mp3|max:2048'
        ]);

        if ($request->file()) {
            $name = time() . '_' . $request->audio->getClientOriginalName();
            $filePath = $request->file('audio')->storeAs('audio/atendimentos', $name, 'public');
            if (!$filePath) {
                return response()->json(['response' => false, 'message' => 'Erro ao carregar o arquivo.']);
            }



            return response()->json(['response' => true, 'data' => $name]);
        }
        return response()->json(['response' => false, 'message' => 'Arquivo não informado.']);
    }

    public function kit(Preso $presos, $kit)
    {
        $this->kit = $kit;
        return $presos->select('presos.*')
            ->join('preso_kits', function ($join) {
                $join->on('preso_kits.preso_id', '=', 'presos.id')
                    ->where('preso_kits.kit', $this->kit)
                    ->where('preso_kits.data_final', NULL);
            })
            ->first();
    }

    public function presoalojamento(Preso $presos, $preso_id)
    {
        return $presos
            ->select('presos.id', 'presos.prontuario', 'presos.nome'
                      , 'galerias.titulo as galeria', 'cubiculos.numero as cubiculo'
                      , 'presos.url_foto')
            ->join('preso_alojamentos', 'preso_alojamentos.preso_id', 'presos.id')
            ->join('cubiculos', 'cubiculos.id', 'preso_alojamentos.cubiculo_id')
            ->join('galerias', 'galerias.id', 'cubiculos.galeria_id')
            ->where('preso_alojamentos.data_saida', NULL)
            ->where('presos.id', $preso_id)
            ->first();   
            
    }
}
