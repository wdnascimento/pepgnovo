<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('galerias')->insert([
            'titulo' => '01-GALERIA',
            'unidade_id' => 1,
            'tipo' => 0
        ]);

        DB::table('galerias')->insert([
            'titulo' => '02-GALERIA',
            'unidade_id' => 1,
            'tipo' => 0
        ]);

        DB::table('galerias')->insert([
            'titulo' => '03-GALERIA',
            'unidade_id' => 1,
            'tipo' => 0
        ]);

        DB::table('galerias')->insert([
            'titulo' => '04-GALERIA',
            'unidade_id' => 1,
            'tipo' => 0
        ]);
        
        DB::table('galerias')->insert([
            'titulo' => '05-GALERIA',
            'unidade_id' => 1,
            'tipo' => 1
        ]);
        
        DB::table('galerias')->insert([
            'titulo' => '06-GALERIA',
            'unidade_id' => 1,
            'tipo' => 1
        ]);
        
        DB::table('galerias')->insert([
            'titulo' => '07-GALERIA',
            'unidade_id' => 1,
            'tipo' => 1
        ]);
        
        DB::table('galerias')->insert([
            'titulo' => '08-GALERIA',
            'unidade_id' => 1,
            'tipo' => 1
        ]);
        
        DB::table('galerias')->insert([
            'titulo' => '09-GALERIA',
            'unidade_id' => 1,
            'tipo' => 1
        ]);
        
        DB::table('galerias')->insert([
            'titulo' => '10-GALERIA',
            'unidade_id' => 1,
            'tipo' => 1
        ]);
    }
}
