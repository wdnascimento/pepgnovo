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
                    {{ Form::open(['id' => 'form-pedido', 'route' => $params['main_route'].'.store','method' =>'post']) }}
                    @endif
                    <div class="row">
                        <!-- Search Credencial -->
                        <div class="form-group col-12 col-md-3 col-lg-3">
                            {{Form::label('credencial', 'Nº Credencial')}}
                            {{Form::hidden('preso_id',null)}}
                            {{Form::hidden('preso_familiar_id',null)}}
                            @if(! isset($data))
                            {{Form::text('credencial',null,['id' =>'credencial',  'class' => 'form-control credencial create orcamento', 'placeholder' => 'Nº Credencial'])}}
                            @else
                            {{Form::text('credencial',null,['id' =>'credencial',  'class' => 'form-control credencial create orcamento', 'readonly', 'placeholder' => 'Nº Credencial'])}}
                            @endif
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
                        <!-- Resultado da busca em readonly -->
                        <div class="form-group col-12 col-md-6 col-lg-6">
                            {{Form::label('nome', 'Nome Familiar')}}
                            {{Form::text('nome',null,['class' => 'form-control', 'placeholder' => 'Nome Familiar/Parentesco', 'readonly', 'data-credencial'=>'nome'])}}
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-6">
                            {{Form::label('rg', 'Nº RG - Familiar')}}
                            {{Form::text('rg',null,['class' => 'form-control', 'placeholder' => 'Nº RG - Familiar','readonly','data-credencial'=>'rg'])}}
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-6">
                            {{Form::label('cpf', 'Nº CPF - Familiar')}}
                            {{Form::text('cpf',null,['class' => 'form-control', 'placeholder' => 'Nº CPF - Familiar','readonly','data-credencial'=>'cpf'])}}
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-6">
                            {{Form::label('afinidade', 'Grau Parentesco')}}
                            {{Form::text('afinidade',null,['class' => 'form-control', 'placeholder' => 'Grau Parentesco','readonly','data-credencial'=>'afinidade'])}}
                        </div>
                        <!-- Preso -->
                        <div class="form-group col-12 col-md-6 col-lg-6">
                            {{Form::label('prontuario', 'Prontuário')}}
                            {{Form::text('prontuario',null,['class' => 'form-control', 'placeholder' => 'Prontuário', 'readonly', 'data-credencial'=>'prontuario'])}}
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-6">
                            {{Form::label('nome_preso', 'Nome Preso')}}
                            {{Form::text('nome_preso',null,['class' => 'form-control', 'placeholder' => 'Nome Preso', 'readonly', 'data-credencial'=>'nome_preso'])}}
                        </div>
                    </div>
                    <hr>
                    <h5>Itens do recebimento (Sacolas / SEDEX)</h5>
                    @if( isset($data) && isset($data->itens))
                    <div class="row" id="itenspedido">
                        @foreach ($data->itens as $item)
                        @php
                        $i=0;
                        @endphp
                        <div class="input-group items">
                            <div class="col-12 col-lg-7  pt-2">
                                {{Form::select('produto_id',
                                                    $preload['produtos'],
                                                    $item->produto_id,
                                                    ['id'=>'produto_id','class' =>'form-control','placeholder' => 'Selecione o Produto','data-name'=>'produto_id'])}}

                            </div>
                            <div class="col-4 col-lg-2 pt-2">
                                {{Form::text('quantidade',str_replace('.',',',$item->quantidade),['class' => 'form-control number qtd', 'data-name' => 'quantidade','placeholder' => 'Qtdade'])}}
                            </div>
                            <div class="col-3 col-lg-1 pt-2">
                                <button type="button" class="btn btn-danger w-100 remove-btn"> - </button>
                            </div>
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </div>
                    @else
                    @if(old('produto_id') == null)
                    <div class="row" id="itenspedido">
                        <div class="input-group items">
                            <div class="col-12 col-lg-7  pt-2">
                                {{Form::select('produto_id',
                                    $preload['produtos'],null,
                                ['id'=>'produto_id','class' =>'form-control','placeholder' => 'Selecione o Produto','data-name'=>'produto_id'])}}
                            </div>
                            <div class="col-4 col-lg-2 pt-2">
                                {{Form::text('quantidade',null,['class' => 'form-control number qtd', 'data-name' => 'quantidade','placeholder' => 'Qtdade'])}}
                            </div>
                            <div class="col-3 col-lg-1 pt-2">
                                <button type="button" class="btn btn-danger w-100 remove-btn"> - </button>
                            </div>
                        </div>
                        <div class="input-group col-12 pt-2">
                            <button type="button" class="btn btn-primary repeater-add-btn"> + Itens</button>
                        </div>
                    </div>
                
                @endif
                @endif
                <div class="form-group pt-3">
                    {{Form::submit('Salvar',['class'=>'btn btn-success btn'])}}
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
<script src="{{ asset('js/plugin/jquery.mask.min.js')}}"></script>
<script src="{{ asset('js/plugin/repeater.js')}}"></script>
<!-- <script src="{{ asset('js/compra.js')}}"></script> -->
<script src="{{ asset('js/ajax.js')}}"></script>
<script src="{{ asset('js/scripts.js')}}"></script>
<script src="{{ asset('js/pedido.js')}}"></script>
<script src="{{ asset('js/clientepedido.js')}}"></script>
@stop