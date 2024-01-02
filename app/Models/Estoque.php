<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model

{
    protected $fillable = ['id', 'preso_id', 'produto_id', 'preso_id', 'quantidade', 'created_at', 'updated_at'];

    public function atualizarEstoque($preso_id, $produto_id, $quantidade, $operacao)
    {
        $produto = new Produto();
        $data = $produto->select('controlado_almox')->find($produto_id);
        //    dd($preso_id, $produto_id, $quantidade, $operacao );
        if ($data['controlado_almox'] == 1) {
            if ($operacao == 0 || $operacao == 1) {
                $estoque = $this->where('produto_id', $produto_id)->where('preso_id', $preso_id)->first();
                if ($estoque) {
                    $tmp_estoque = [];
                  
                    if ($operacao == 1) {
                        $tmp_estoque['quantidade'] =  $estoque['quantidade'] + $quantidade;
                        
                    } else {
                        if ($estoque['quantidade'] >= $quantidade) {
                            $tmp_estoque['quantidade'] = ($estoque['quantidade'] - $quantidade);
                        } else {
                            return false;
                        }
                    }
                    if (!$this->find($estoque['id'])->update($tmp_estoque)) {
                        return false;
                    }
                    
                    return true;
                } else {
                    if ($operacao == 1) {
                        $estoque = [];
                        $estoque['produto_id'] = $produto_id;
                        $estoque['preso_id'] = $preso_id;
                        $estoque['quantidade'] = $quantidade;
                        if (!$this->create($estoque)) {
                            return false;
                        }
                        return true;
                    }
                    return false;
                }
            }
            return false;
        }
        return true;
    }
}
