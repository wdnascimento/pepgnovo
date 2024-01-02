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
                            <a href="{{ route($params['main_route'].'.index')}}" class="btn btn-primary btn-xs"><span class="fas fa-arrow-left"></span>  Voltar</a>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body ">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0 ">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::open(['route' => $params['main_route'].'.store','method' =>'post' , 'enctype'=> 'multipart/form-data']) }}
                    <div class="row">
                        {{--
                            id, titulo, data_hora, importado, usuario, deleted_at, created_at, updated_at
                            --}}

                        <div class="form-group col-12 col-md-12 col-lg-12">
                            {{Form::label('file', 'Arquivo - Selecione o arquivo .CSV')}}
                            {{Form::file('file',null,['class' => 'form-control','width' => '150', 'placeholder' => 'Arquivo'])}}
                        </div>
                        <div class="form-group col-12 alert alert-warning">
                            Atenção!! Este arquivo deve conter a listagem gerada pelo SIGEP - Relatórios/Listagem por Cela
                        </div>
                        <div class="form-group col-12 col-md-12 col-lg-12 pt-2">
                            {{Form::submit('Salvar',['class'=>'btn btn-success btn-sm'])}}
                        </div>
                       
                    </div>
                    {{ Form::close() }}
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
    <script src="{{ asset('js/scripts.js')}}" ></script>
@stop
