<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CubiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $galerias = DB::table('galerias')->select('id')->where('tipo',0)->orderby('titulo')->get();
        foreach($galerias as $galeria){
            for($cubiculo= 1;$cubiculo<=24; $cubiculo++ ){
                DB::table('cubiculos')->insert([
                    'numero' => ($galeria->id *100) + $cubiculo,
                    'capacidade' => 8,
                    'galeria_id' => $galeria->id
                ]);
            }
            
        }

        $galerias = DB::table('galerias')->select('id')->where('tipo',1)->get();
        foreach($galerias as $galeria){
            for($cubiculo= 1;$cubiculo<=3; $cubiculo++ ){
                DB::table('cubiculos')->insert([
                    'numero' => ($galeria->id *100) + $cubiculo,
                    'capacidade' => 1,
                    'galeria_id' => $galeria->id
                ]);
            }
            
        }
        
    }
}
