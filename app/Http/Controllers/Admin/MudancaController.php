<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PresoAlojamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MudancaController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only('preso_id', 'cubiculo_id');

        $preso_alojamento = new PresoAlojamento();
        $alojamento_atual = $preso_alojamento
            ->select('id', 'cubiculo_id')
            ->where('preso_id', $data['preso_id'])
            ->where('data_saida', NULL)
            ->first();
        if (($alojamento_atual)) {
            // IDENTIFICADO ALOJAMENTO

            if ($alojamento_atual['cubiculo_id'] != $data['cubiculo_id']) {
                $result = $preso_alojamento->find($alojamento_atual['id'])->update(
                    [
                        'data_saida' => \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo'),
                        'motivo' => 'Movimentação interna - Usuário: '.Auth::user()->name,
                    ]
                );

                if (!$result) {
                    return redirect()->back()->withErrors(['Erro a zerar alojamento']);
                }
                $tmp_alojamento_preso = [];
                $tmp_alojamento_preso["preso_id"] = $data['preso_id'];
                $tmp_alojamento_preso["cubiculo_id"] =  $data['cubiculo_id'];
                $tmp_alojamento_preso["data_entrada"] = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
                $tmp_alojamento_preso["motivo"] = '';
                if (!$preso_alojamento->insert($tmp_alojamento_preso)) {
                    return redirect()->back()->withErrors(['Erro ao criar novo alojamento']);
                }
                return redirect()->back();
            } else {
                return redirect()->back()->withErrors(['Preso Já se encontra neste alojamento']);
            }
        } else {
            return redirect()->back()->withErrors(['Erro ao localizar alojamento']);
        }
    }
}
