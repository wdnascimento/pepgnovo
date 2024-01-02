@extends('adminlte::page')
@section('title', config('admin.title'))
@section('content_header')
@include('admin.layouts.header')
@stop
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">{{$params['subtitulo']}}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route($params['main_route'].'.index')}}" class="btn btn-primary btn-xs"><span class="fas fa-arrow-left"></span> Voltar</a>
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
                    @if( isset($data))
                    {{
                            Form::model($data,[
                                'route' => [$params['main_route'].'.update',$data->id]
                                ,'class' => 'form'
                                ,'method' => 'put'
                            ])
                        }}
                    @else
                    {{ Form::open(['route' => $params['main_route'].'.store','method' =>'post']) }}
                    @endif
                    <div class="row">
                        <!-- Search Credencial -->
                        <div class="form-group col-12 col-md-3 col-lg-3">
                            {{Form::label('prontuario', 'Nº Prontuário Preso')}}
                            {{Form::hidden('preso_id', null)}}
                            {{Form::text('prontuario',null,['id' =>'prontuario',  'class' => 'form-control prontuario create orcamento', 'placeholder' => 'Nº Prontuário'])}}
                        </div>
                        <div class="form-group col-12 col-md-3 col-lg-3">
                            {{Form::label('kit', 'Nº Kit')}}
                            {{Form::text('kit',null,['id' =>'kit',  'class' => 'form-control kit create', 'placeholder' => 'Nº Kit'])}}
                        </div>
                        <!-- Buscar -->
                        <div class="form-group col-6 col-md-6 col-lg-6 d-flex justify-content-start">
                            @if(! isset($data))
                            <div class="d-flex align-self-end">
                                <a id="btn-buscar" class="btn btn-light btn-md ml-2"><span class="fas fa-search"></span> Buscar</a>
                            </div>
                            <div class="row d-flex align-self-end p-2">
                                <strong><span class="text-danger" id="response"></span></strong>
                            </div>
                            @endif
                        </div>
                        <!-- Preso -->
                        <div class="form-group col-12 col-md-6 col-lg-12">
                            {{Form::label('nome_preso', 'Nome Preso')}}
                            {{Form::text('nome_preso',null,['class' => 'form-control','placeholder' => 'Nome Preso', 'readonly','data-credencial'=>'nome_preso']
                            )}}
                        </div>
                        <div class="col-9 col-lg-9  pt-2">
                            {{Form::label('produto', 'Produto')}}
                            {{Form::select('produto_id',
                                    $preload['produtos'],
                                    null,
                                    ['id'=>'produto_id','class' =>'form-control','placeholder' => 'Selecione o Produto','data-name'=>'produto_id'])}}
                        </div>
                        <div class="col-3 col-lg-3 pt-2">
                            {{Form::label('quantidade', 'Quantidade')}}
                            {{Form::text('quantidade',null,['class' => 'form-control quantidade', 'data-name' => 'quantidade','placeholder' => 'Qtdade'])}}
                        </div>                       
                        <div class="form-group col-9 col-md-9 col-lg-12">
                            {{Form::label('motivo', 'Motivo')}}
                            {{Form::textarea('motivo',null,['class' => 'form-control','rows' => 2, 'placeholder' => 'Descreva o motivo'])}}
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
@section('js')
<script src="{{ asset('plugin/jquery.mask.min.js')}}"></script>
<script src="{{ asset('js/scripts.js')}}"></script>
<script src="{{ asset('js/buscakit.js')}}"></script>
<script src="{{ asset('js/buscapreso.js')}}"></script>
@stop