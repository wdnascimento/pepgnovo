@extends('adminlte::page')
@section('title', config('admin.title'))
@section('content_header')
@include('admin.layouts.header')
@stop
@section('content')
<section class="content">
    <div id="app" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row p-2">
                        <div class="col-6">
                            <h3 class="card-title font-weight-bold">{{$params['subtitulo']}}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route($params['main_route'].'.create') }}" class="btn btn-primary btn-xs"><span class="fas fa-plus"></span> Novo Cadastro</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if(isset($data) && count($data))
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Nome Preso</th>
                                <th>Cadastrado Por</th>
                                <th>Data</th>
                                <th>Operações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['id']}}</td>
                                <td>{{ $item['desc_produto']}}</td>
                                <td>{{ $item['quantidade']}}</td>
                                <td>{{ $item['nome_preso']}}</td>
                                <td>{{ $item['cadastrado_por'] }}</td>
                                <td>{{ $item['data_cadastro'] }}</td>
                                <td>
                                    <a href="{{ route($params['main_route'].'.show', $item['id']) }}" class="btn btn-outline-info btn-xs"> Visualizar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-success m-2" role="alert">
                        Nenhuma informação cadastrada.
                    </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
@stop
@section('css')
@stop
@section('js')
@stop