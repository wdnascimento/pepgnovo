<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Atendimento;
use App\Models\Parametro;
use App\Models\Setor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SetorController extends Controller
{

    private $setor;
    private $atendimento;
    private $parametro;


    public function __construct(Setor $setores, Atendimento $atendimentos, Parametro $parametros)
    {
        $this->setor = $setores;
        $this->atendimento = $atendimentos;
        $this->parametro = $parametros;
    }
    public function index($preso_id)
    {
        $parametro = $this->parametro->select('valor')->where('titulo', 'limite_atendimento')->get()->first();
        $atendimento = $this->atendimento->select('setor_id')->where('preso_id', $preso_id)->whereDate('created_at', Carbon::today())->get()->toArray();

        if (($parametro != NULL) && (sizeof($atendimento) >= $parametro['valor'])) {
            return response()->json(['response' => false, 'message' => 'Excedeu o Limite de Atendimento diário.']);
        }
        return $this->setor->where('atendimento_online', 1)->whereNotIn('id', array_unique($atendimento, SORT_REGULAR))->get();
    }
}
