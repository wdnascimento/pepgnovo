@extends('adminlte::page')

@section('title', config('admin.title'))

@section('content_header')
    @include('admin.layouts.header')
@stop

@section('content')
    <section class="content" >
       <div class="row">
           <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">{{$params['subtitulo']}}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route($params['main_route'].'.create')}}" class="btn btn-primary btn-xs"><span class="fas fa-plus"></span> Novo Cadastro</a>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    @if(isset($data) && count($data))
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Unidade</th>
                                <th>Titulo</th>
                                <th>Operação</th>
                            </tr>
                            </thead>
                            <tbody>
                                <!-- id, titulo, data_hora, importado, usuario, deleted_at, created_at, updated_at -->
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->unidade}}</td>
                                    <td>{{ $item->titulo}}</td>
                                    <td>
                                        <a href="{{ route($params['main_route'].'.edit', $item->id) }}" class="btn btn-primary btn-xs"><span class="fas fa-edit"></span> Editar</a> 
                                        <a href="{{ route($params['main_route'].'.show', $item->id) }}" class="btn btn-danger btn-xs"><span class="fas fa-trash"></span> Deletar</a> 
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
