<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Wagner Demetrio do Nascimento',
            'email' => 'wagnerinfo@deppen',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('wagner3012'),
            'remember_token' => 'remember_token',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Enfermaria PEPG II PG',
            'email' => 'enfermaria@deppen',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('enfermaria'),
            'remember_token' => 'remember_token',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Portaria PEPG II PG',
            'email' => 'portaria@deppen',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('portaria'),
            'remember_token' => 'remember_token',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Almoxarifado PEPG II PG',
            'email' => 'almoxarifado@deppen',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('almoxarifado'),
            'remember_token' => 'remember_token',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Portaria PEPG II PG',
            'email' => 'vagner@deppen',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('vagner'),
            'remember_token' => 'remember_token',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            
        ]);
        
    }
}
