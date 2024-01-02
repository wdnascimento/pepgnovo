<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return redirect('admin');
    });
});

Route::get('/atendimento', function () {
    return view('audio.index');
});

Route::get('/axios', function () {
    return view('axios');
});


Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('/', 'IndexController@index')->name('home');
    Route::get('/home', 'IndexController@index')->name('home');

    //ArquivoSigep
    Route::get('arquivo_sigep', 'ArquivoSigepController@index')->name('admin.arquivo_sigep.index');
    Route::get('arquivo_sigep/create', 'ArquivoSigepController@create')->name('admin.arquivo_sigep.create');
    Route::post('arquivo_sigep/store', 'ArquivoSigepController@store')->name('admin.arquivo_sigep.store');
    Route::get('arquivo_sigep/import/{id}', 'ArquivoSigepController@import')->name('admin.arquivo_sigep.import');
    Route::get('arquivo_sigep/show/{id}', 'ArquivoSigepController@show')->name('admin.arquivo_sigep.show');
    Route::put('arquivo_sigep/update/{id}', 'ArquivoSigepController@update')->name('admin.arquivo_sigep.update');
    Route::delete('arquivo_sigep/destroy/{id}', 'ArquivoSigepController@destroy')->name('admin.arquivo_sigep.destroy');

    //ArquivoVisitaSigep
    Route::get('arquivo_visita_sigep', 'ArquivoVisitaSigepController@index')->name('admin.arquivo_visita_sigep.index');
    Route::get('arquivo_visita_sigep/create', 'ArquivoVisitaSigepController@create')->name('admin.arquivo_visita_sigep.create');
    Route::post('arquivo_visita_sigep/store', 'ArquivoVisitaSigepController@store')->name('admin.arquivo_visita_sigep.store');
    Route::get('arquivo_visita_sigep/import/{id}', 'ArquivoVisitaSigepController@import')->name('admin.arquivo_visita_sigep.import');
    Route::get('arquivo_visita_sigep/show/{id}', 'ArquivoVisitaSigepController@show')->name('admin.arquivo_visita_sigep.show');
    Route::put('arquivo_visita_sigep/update/{id}', 'ArquivoVisitaSigepController@update')->name('admin.arquivo_visita_sigep.update');
    Route::delete('arquivo_visita_sigep/destroy/{id}', 'ArquivoVisitaSigepController@destroy')->name('admin.arquivo_visita_sigep.destroy');


    //Galeria
    Route::get('galeria', 'GaleriaController@index')->name('admin.galeria.index');
    Route::get('galeria/create', 'GaleriaController@create')->name('admin.galeria.create');
    Route::post('galeria/store', 'GaleriaController@store')->name('admin.galeria.store');
    Route::get('galeria/edit/{id}', 'GaleriaController@edit')->name('admin.galeria.edit');
    Route::get('galeria/show/{id}', 'GaleriaController@show')->name('admin.galeria.show');
    Route::put('galeria/update/{id}', 'GaleriaController@update')->name('admin.galeria.update');
    Route::delete('galeria/destroy/{id}', 'GaleriaController@destroy')->name('admin.galeria.destroy');
    Route::get('galerias', 'GaleriaController@galerias')->name('admin.galeria.galerias');
    Route::get('galeria/{id}', 'GaleriaController@galeria')->name('admin.galeria.galeria');

    //Presos
    Route::get('preso', 'PresoController@index')->name('admin.preso.index');
    Route::get('preso/por_cubiculo', 'CubiculoController@presosPorCubiculo')->name('admin.preso.por_cubiculo');
    Route::get('preso/foto', 'PresoController@fotos')->name('admin.preso.foto');
    Route::get('preso/historico/{preso_id}', 'PresoController@historico')->name('admin.preso.historico');
    Route::get('preso/edit/{id}', 'PresoController@edit')->name('admin.preso.edit');
    Route::post('preso/store', 'PresoController@store')->name('admin.preso.store');
    
    //Mudancas
    Route::post('mudanca/store', 'MudancaController@store')->name('admin.mudanca.store');
    // Route::get('mudancas', 'MudancasController@index')->name('admin.mudancas.index');
    // Route::get('mudancas/por_cubiculo', 'CubiculoController@mudancassPorCubiculo')->name('admin.mudancas.por_cubiculo');
    // Route::get('mudancas/foto', 'MudancasController@fotos')->name('admin.mudancas.foto');
    // Route::get('mudancas/edit/{id}', 'MudancasController@edit')->name('admin.mudancas.edit');
    // Route::post('mudancas/store', 'MudancasController@store')->name('admin.mudancas.store');

    //Setor
    Route::get('setor', 'SetorController@index')->name('admin.setor.index');
    Route::get('setor/create', 'SetorController@create')->name('admin.setor.create');
    Route::post('setor/store', 'SetorController@store')->name('admin.setor.store');
    Route::get('setor/edit/{id}', 'SetorController@edit')->name('admin.setor.edit');
    Route::get('setor/show/{id}', 'SetorController@show')->name('admin.setor.show');
    Route::put('setor/update/{id}', 'SetorController@update')->name('admin.setor.update');

    //Atendimentos
    Route::get('setor/atendimento', 'AtendimentoController@index')->name('admin.atendimento.index');
    Route::get('setor/atendimento/setor/{id}', 'AtendimentoController@atendimentoSetor')->name('admin.atendimento.setor');
    Route::get('setor/atendimento/responder/{id}', 'AtendimentoController@responder')->name('admin.atendimento.responder');
    Route::get('setor/atendimento/responder-audio/{id}', 'AtendimentoController@responderAudio')->name('admin.atendimento.responder-audio');
    Route::put('setor/atendimento/{id}', 'AtendimentoController@update')->name('admin.atendimento.update');


    //Veiculos
    Route::get('veiculo', 'VeiculoController@index')->name('admin.veiculo.index');
    Route::get('veiculo/create', 'VeiculoController@create')->name('admin.veiculo.create');
    Route::post('veiculo/store', 'VeiculoController@store')->name('admin.veiculo.store');
    Route::get('veiculo/edit/{id}', 'VeiculoController@edit')->name('admin.veiculo.edit');
    Route::get('veiculo/show/{id}', 'VeiculoController@show')->name('admin.veiculo.show');
    Route::put('veiculo/update/{id}', 'VeiculoController@update')->name('admin.veiculo.update');
    Route::delete('veiculo/destroy/{id}', 'VeiculoController@destroy')->name('admin.veiculo.destroy');

    //Pessoas
    Route::get('pessoa', 'PessoaController@index')->name('admin.pessoa.index');
    Route::get('pessoa/create', 'PessoaController@create')->name('admin.pessoa.create');
    Route::post('pessoa/store', 'PessoaController@store')->name('admin.pessoa.store');
    Route::get('pessoa/edit/{id}', 'PessoaController@edit')->name('admin.pessoa.edit');
    Route::get('pessoa/show/{id}', 'PessoaController@show')->name('admin.pessoa.show');
    Route::put('pessoa/update/{id}', 'PessoaController@update')->name('admin.pessoa.update');
    Route::delete('pessoa/destroy/{id}', 'PessoaController@destroy')->name('admin.pessoa.destroy');

    //ControleAcesso
    Route::get('controleacesso', 'ControleAcessoController@index')->name('admin.controleacesso.index');
    Route::get('controleacesso/create', 'ControleAcessoController@create')->name('admin.controleacesso.create');
    Route::post('controleacesso/store', 'ControleAcessoController@store')->name('admin.controleacesso.store');
    Route::get('controleacesso/edit/{id}', 'ControleAcessoController@edit')->name('admin.controleacesso.edit');
    Route::get('controleacesso/show/{id}', 'ControleAcessoController@show')->name('admin.controleacesso.show');
    Route::put('controleacesso/update/{id}', 'ControleAcessoController@update')->name('admin.controleacesso.update');
    Route::delete('controleacesso/destroy/{id}', 'ControleAcessoController@destroy')->name('admin.controleacesso.destroy');
    
    //ControleAcesso_extra
    Route::get('controleacesso/exit/{id}', 'ControleAcessoController@exit')->name('admin.controleacesso.exit');
    Route::put('controleacesso/exit/{id}', 'ControleAcessoController@updateexit')->name('admin.controleacesso.updateexit');

    //Cadstro de produto
    Route::get('produto', 'ProdutoController@index')->name('admin.produto.index');
    Route::get('produto/create', 'ProdutoController@create')->name('admin.produto.create');
    Route::post('produto/store', 'ProdutoController@store')->name('admin.produto.store');
    Route::get('produto/edit/{id}', 'ProdutoController@edit')->name('admin.produto.edit');
    Route::get('produto/show/{id}', 'ProdutoController@show')->name('admin.produto.show');
    Route::put('produto/update/{id}', 'ProdutoController@update')->name('admin.produto.update');
    Route::delete('produto/destroy/{id}', 'ProdutoController@destroy')->name('admin.produto.destroy');
    
    //Controle de kit
    Route::get('preso_kit', 'KitController@index')->name('admin.preso_kit.index');
    //
    Route::get('preso_kit/trocarKit/{id}', 'KitController@trocarKit')->name('admin.preso_kit.trocarKit');
    Route::put('preso_kit/liberar/{id}', 'KitController@liberar')->name('admin.preso_kit.liberar');
    //
    Route::get('preso_kit/atribuirKit/{preso_id}', 'KitController@atribuirKit')->name('admin.preso_kit.atribuirKit');
    Route::put('preso_kit/atribuir/{preso_id}', 'KitController@atribuir')->name('admin.preso_kit.atribuir');
    //
    Route::get('preso_kit/create', 'KitController@create')->name('admin.preso_kit.create');
    //
    Route::get('produto/show/{id}', 'ProdutoController@show')->name('admin.produto.show');
    Route::delete('preso_kit/destroy/{id}', 'KitController@destroy')->name('admin.preso_kit.destroy');


     //Recebimento
     Route::get('recebimento', 'RecebimentoController@index')->name('admin.recebimento.index');
     Route::get('recebimento/create', 'RecebimentoController@create')->name('admin.recebimento.create');
     Route::post('recebimento/store', 'RecebimentoController@store')->name('admin.recebimento.store');
     Route::get('recebimento/edit/{id}', 'RecebimentoController@edit')->name('admin.recebimento.edit');
     Route::get('recebimento/show/{id}', 'RecebimentoController@show')->name('admin.recebimento.show');
     Route::put('recebimento/update/{id}', 'RecebimentoController@update')->name('admin.recebimento.update');
     Route::delete('recebimento/destroy/{id}', 'RecebimentoController@destroy')->name('admin.recebimento.destroy');

     //Recebimento
     Route::get('triagem', 'TriagemController@index')->name('admin.triagem.index');
     Route::get('triagem/create', 'TriagemController@create')->name('admin.triagem.create');
     Route::post('triagem/store', 'TriagemController@store')->name('admin.triagem.store');
     Route::get('triagem/edit/{id}', 'TriagemController@edit')->name('admin.triagem.edit');
     Route::get('triagem/show/{id}', 'TriagemController@show')->name('admin.triagem.show');
     Route::put('triagem/update/{id}', 'TriagemController@update')->name('admin.triagem.update');
     Route::delete('triagem/destroy/{id}', 'TriagemController@destroy')->name('admin.triagem.destroy');

     //Estoque
     Route::get('estoque', 'EstoqueController@index')->name('admin.estoque.index');
     Route::get('estoque/create', 'EstoqueController@create')->name('admin.estoque.create');
     Route::post('estoque/store', 'EstoqueController@store')->name('admin.estoque.store');
     Route::get('estoque/edit/{id}', 'EstoqueController@edit')->name('admin.estoque.edit');
     Route::get('estoque/show/{id}', 'EstoqueController@show')->name('admin.estoque.show');
     Route::put('estoque/update/{id}', 'EstoqueController@update')->name('admin.estoque.update');
     Route::delete('estoque/destroy/{id}', 'EstoqueController@destroy')->name('admin.estoque.destroy');

     //Baixa Material Pertences
     Route::any('baixa_material', ['uses'=>'BaixaMaterialController@index'])->name('admin.baixa_material.index');
     Route::get('baixa_material/create', ['uses'=>'BaixaMaterialController@create'])->name('admin.baixa_material.create');
     Route::post('baixa_material/store', ['uses'=>'BaixaMaterialController@store'])->name('admin.baixa_material.store');
     Route::get('baixa_material/show/{id}', ['uses' =>'BaixaMaterialController@show'])->name('admin.baixa_material.show');
     Route::delete('baixa_material/destroy/{id}', ['uses'=>'BaixaMaterialController@destroy', 'is' => 'admin'])->name('admin.baixa_material.destroy');

});
