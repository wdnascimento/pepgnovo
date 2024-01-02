<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Recebimento extends Model
{
    // id, preso_id, preso_familiar_id, data_hora, cadastrado_por, created_at, updated_at
    protected $fillable = ['id',  'preso_id', 'preso_familiar_id', 'data_hora', 'cadastrado_por'];


    public function itens()
    {
        return $this->hasMany('App\Models\RecebimentoItens');
    }
   
    public function itensNaoControlados()
    {
        return $this->hasManyThrough('App\Models\Produto','App\Models\RecebimentoItens');
    }

    public function status()
    {
        return $this->hasMany('App\Models\RecebimentoStatus');
    }

    public function preso()
    {
        return $this->hasOne('App\Models\Preso', 'id', 'preso_id');
    }

    public function getStatusAtual()
    {
        return $this->hasMany('App\Models\RecebimentoStatus')->where('fim', NULL);
    }

    public function getTriagem()
    {
        return $this->hasMany('App\Models\RecebimentoStatus')->where('fim', NULL)->where('status', '>', 1);
    }

    public function getStatusEntradaAlmox()
    {
        return $this->hasMany('App\Models\RecebimentoStatus')->where('fim', NULL)->where('status', 2);
    }


    public function getStatusEntreguePreso()
    {
        return $this->hasMany('App\Models\RecebimentoStatus')->where('fim', NULL)->where('status', 3);
    }


    
    public function getRecebimento($id)
    {
        return $this->with('itens')
            ->with('status')
            ->with('getStatusAtual')
            ->with('preso')
            // ->with('itensNaoControlados')
            ->find($id);
      
    }

    public function lancarBaixaPedido($id, $baixa_estoque)
    {
        $itens = $this  ->join('recebimento_itens', 'recebimento_itens.recebimento_id', 'recebimentos.id')
                        ->join('produtos', 'produtos.id', 'recebimento_itens.produto_id')
                        ->where('produtos.controlado_almox', 1)
                        ->where('recebimento_itens.recebimento_id', $id)
                        ->get();
        
        if ($itens) {

            $baixa_material = new BaixaMaterial();
            $estoque = new Estoque();

            DB::beginTransaction();

            foreach ($itens as $item) {
                if(isset($baixa_estoque['baixa_estoque'][$item->produto_id])){
                    $data['preso_id'] = $item->preso_id;
                    $data['produto_id'] = $item->produto_id;
                    $data['quantidade'] = $item->quantidade;
                    $data['motivo'] = 'LANÇAMENTO AUTOMATICO POR MUDANÇA DE STATUS (ENTREGUE AO PRESO)';
                    $data['cadastrado_por'] = Auth::user()->email;
                    $data['data_cadastro'] = date('Y-m-d');

            
                    $insert = $baixa_material->create($data);
                
                
                    if (!$insert) {
                        DB::rollback();
                        return false;
                    }

                    if (!$estoque->atualizarEstoque(
                            $data['preso_id'],
                            $data['produto_id'],
                            $data['quantidade'], 0
                        )) {
                    
                        DB::rollBack();
                        return false;
                    }

                }                
            }

            DB::commit();
            return true;
        }

        return true;
    }
}
