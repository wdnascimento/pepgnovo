<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecebimentoItens extends Model
{
    // id, recebimento_id, produto_id, quantidade, created_at, updated_at
    protected $fillable = ['id','preso_id', 'recebimento_id', 'produto_id', 'quantidade', 'desc_produto'];

    protected $appends = ['descricao'];


    public function getDescProdutoAttribute()
    {
        $this->produto = new Produto();
        $tmp_value = $this->produto->select('descricao as desc_produto')->find($this->produto_id);
        return $tmp_value['descricao'];
    }
}
