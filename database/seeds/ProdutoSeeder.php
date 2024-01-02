<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            'descricao'=>'Chinelo Preto',
            'categoria'=>'1',
            'unidade_medida'=>'3',
            'controlado_almox'=>'1',
            'periodicidade'=>'180',
            'observacao'=>'Modelo Havaianas',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Desodorante Roll On 50Ml',
            'categoria'=>'1',
            'unidade_medida'=>'5',
            'controlado_almox'=>'1',
            'periodicidade'=>'30',
            'observacao'=>'Roll On 50Ml',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Desinfetante 500ml',
            'categoria'=>'1',
            'unidade_medida'=>'5',
            'controlado_almox'=>'1',
            'periodicidade'=>'30',
            'observacao'=>'Desinfetante 500ml',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Creme Dental',
            'categoria'=>'1',
            'unidade_medida'=>'2',
            'controlado_almox'=>'1',
            'periodicidade'=>'30',
            'observacao'=>'Creme Dental Close Up 100g',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Cueca Preta',
            'categoria'=>'1',
            'unidade_medida'=>'3',
            'controlado_almox'=>'1',
            'periodicidade'=>'90',
            'observacao'=>'Cueca preta *Apenas 2 unidades*',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);

        //Produtos de consumo diário do Preso
        DB::table('produtos')->insert([
            'descricao'=>'Pão Fatiado',
            'categoria'=>'2',
            'unidade_medida'=>'3',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Pão Fatiado *Apenas 2 unidades*',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Achocolatado - 800gr',
            'categoria'=>'2',
            'unidade_medida'=>'2',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Achocolatado - 800gr',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Leite em Pó - 800gr',
            'categoria'=>'2',
            'unidade_medida'=>'2',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Leite em Pó - 800gr',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Farofa - 500gr',
            'categoria'=>'2',
            'unidade_medida'=>'2',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Farofa - 500gr',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Doce de Leite - Sem mistura',
            'categoria'=>'2',
            'unidade_medida'=>'3',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Doce de Leite - Sem mistura',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Barras de Chocolate ao Leite - MÁX. 450gr',
            'categoria'=>'2',
            'unidade_medida'=>'3',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Barras de Chocolate ao Leite - MÁX. 450gr',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Bolacha Isabel - Doce',
            'categoria'=>'2',
            'unidade_medida'=>'3',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Bolacha Isabel - Doce',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Bolacha Isabel - Salgada',
            'categoria'=>'2',
            'unidade_medida'=>'3',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Bolacha Isabel - Salgada',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Açucar - 1kg',
            'categoria'=>'2',
            'unidade_medida'=>'1',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Açucar - 1kg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
        DB::table('produtos')->insert([
            'descricao'=>'Suco em Pó',
            'categoria'=>'2',
            'unidade_medida'=>'3',
            'controlado_almox'=>'2',
            'periodicidade'=>'30',
            'observacao'=>'Suco em Pó ou 250gr em uma unidade',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>NULL,            
        ]);
    }
}
