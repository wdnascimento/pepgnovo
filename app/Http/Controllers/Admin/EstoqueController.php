<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaixaMaterial;
use App\Models\Estoque;
use App\Models\Preso;
use App\Models\Produto;
use App\Models\Recebimento;
use App\Models\RecebimentoItens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller
{
    
    private $estoque;
    private $params;

    public function __construct(Estoque $estoques)
    {
        
        $this->estoque = $estoques;
             

        // Default values
        $this->params['titulo']='Saldo de pertences por Presos';
        $this->params['main_route']='admin.estoque';
    }

    public function index(Request $request)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Saldo de pertences/Presos';
        $this->params['arvore'][0] = [
                    'url' => 'admin/estoque',
                    'titulo' => 'Saldo'
        ];
              
        $params = $this->params;
        $data = $this->estoque
            
            ->select('presos.prontuario','presos.nome', 'produtos.descricao', 'estoques.quantidade as quantidade', 'preso_kits.kit as kit')
            ->join('produtos', 'produtos.id', 'estoques.produto_id')
            ->join('presos', 'presos.id', 'estoques.preso_id')
            ->leftJoin('preso_kits', function ($join) {
                $join->on('preso_kits.preso_id', '=', 'presos.id')
                    ->where('preso_kits.data_final', NULL);
            })

            ->paginate(10);
            //  dd($data);
            return view('admin.estoque.index',compact('params','data'));
    }
}
