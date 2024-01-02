<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TIPO ISOLAMENTO/GALERIA CODES

        DB::table('table_codes')->insert([
            'pai' => '1',
            'item' => '0',
            'valor' => 'TIPO ISOLAMENTO',
            'descricao' => 'TIPO ISOLAMENTO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '1',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'ISOLAMENTO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '1',
            'item' => '2',
            'valor' => 0,
            'descricao' => 'NORMAL',
        ]);

         // VEICULOS CODES

        DB::table('table_codes')->insert([
            'pai' => '2',
            'item' => '0',
            'valor' => 'TIPO VEÍCULO',
            'descricao' => 'TIPO VEÍCULO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '2',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'OFICIAL',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '2',
            'item' => '2',
            'valor' => 2,
            'descricao' => 'PARTICULAR',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '2',
            'item' => '3',
            'valor' => 3,
            'descricao' => 'OUTROS',
        ]);


        // PESSOAS CODES

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '0',
            'valor' => 'TIME ESCALA',
            'descricao' => 'TIME ESCALA',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'ALPHA DIURNO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '2',
            'valor' => 2,
            'descricao' => 'ALPHA NOTURNO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '3',
            'valor' => 3,
            'descricao' => 'BRAVO DIURNO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '4',
            'valor' => 4,
            'descricao' => 'BRAVO NOTURNO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '5',
            'valor' => 5,
            'descricao' => 'CHARLIE DIURNO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '6',
            'valor' => 6,
            'descricao' => 'CHARLIE NOTURNO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '7',
            'valor' => 7,
            'descricao' => 'DELTA DIURNO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '3',
            'item' => '8',
            'valor' => 8,
            'descricao' => 'DELTA NOTURNO',
        ]);


        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '0',
            'valor' => 'TIPO PESSOA',
            'descricao' => 'TIPO PESSOA',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'ESTATUTÁRIO DEPEN',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '2',
            'valor' => 2,
            'descricao' => 'FUNCIONÁRIO TERCEIRIZADO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '4',
            'valor' => 3,
            'descricao' => 'PROFESSOR',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '4',
            'valor' => 4,
            'descricao' => 'RELIGIOSOS',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '5',
            'valor' => 5,
            'descricao' => 'VISITANTES',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '6',
            'valor' => 6,
            'descricao' => 'FAMILIARES DE PPL',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '7',
            'valor' => 7,
            'descricao' => 'TERCEIRIZADOS',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '4',
            'item' => '8',
            'valor' => 8,
            'descricao' => 'OUTROS',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '5',
            'item' => '0',
            'valor' => 'TIPO ENTRADA',
            'descricao' => 'TIPO ENTRADA',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '5',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'PESSOA',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '5',
            'item' => '2',
            'valor' => 2,
            'descricao' => 'VEICULO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '6',
            'item' => '0',
            'valor' => 'TIPO CATEGORIA PRODUTO',
            'descricao' => 'TIPO CATEGORIA PRODUTO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '6',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'PERTENCES PPL',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '6',
            'item' => '2',
            'valor' => 2,
            'descricao' => 'ALIMENTOS PPL',
        ]);
        
        DB::table('table_codes')->insert([
            'pai' => '6',
            'item' => '3',
            'valor' => 3,
            'descricao' => 'PRODUTO DE USO/CONSUMO DA UNIDADE',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '7',
            'item' => '0',
            'valor' => 'CONTROLE DE SALDO',
            'descricao' => 'CONTROLE DE SALDO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '7',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'SIM',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '7',
            'item' => '2',
            'valor' => 2,
            'descricao' => 'NÃO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '8',
            'item' => '0',
            'valor' => 'UNIDADE DE MEDIDA PRODUTO',
            'descricao' => 'UNIDADE MEDIDA PRODUTO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '8',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'QUILOGRAMA (kg)',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '8',
            'item' => '2',
            'valor' => 2,
            'descricao' => 'GRAMA (gr)',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '8',
            'item' => '3',
            'valor' => 3,
            'descricao' => 'UNIDADE',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '8',
            'item' => '4',
            'valor' => 4,
            'descricao' => 'LITRO (l)',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '8',
            'item' => '5',
            'valor' => 5,
            'descricao' => 'MILILITRO (ml)',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '8',
            'item' => '6',
            'valor' => 6,
            'descricao' => 'P / M / G / GG',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '9',
            'item' => '0',
            'valor' => 'STATUS DO RECEBIMENTO',
            'descricao' => 'STATUS DO RECEBIMENTO',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '9',
            'item' => '1',
            'valor' => 1,
            'descricao' => 'RECEPCIONADO PORTARIA',
        ]);
        
        DB::table('table_codes')->insert([
            'pai' => '9',
            'item' => '2',
            'valor' => 2,
            'descricao' => 'ENTRADA ALMOX.',
        ]);

        DB::table('table_codes')->insert([
            'pai' => '9',
            'item' => '3',
            'valor' => 3,
            'descricao' => 'ENTREGUE P/ PRESO',
        ]);
        
    }
}
