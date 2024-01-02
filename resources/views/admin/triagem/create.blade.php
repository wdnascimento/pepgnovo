@extends('adminlte::page')
@section('title', config('admin.title'))
@section('content_header')
@include('admin.layouts.header')
@stop
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
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
                    @endif
                    <h5>Dados do Preso</h5>
                    <div class="row">
                        <div class="form-group col-12 col-md-4 col-lg-4">
                            {{Form::label('nome_preso', 'Nome Preso')}}
                            {{Form::text('nome_preso',$data->preso->nome,['id' =>'nome_preso',  'class' => 'form-control nome_preso create',  'readonly', 'placeholder' => 'Nome Preso'])}}
                        </div>
                    </div>
                   <hr>
                    <h5>Itens Recebido</h5>
                    <div class="row" id="">
                        @foreach ($data->itens as $item)
                        @php
                        $i=0;
                        @endphp
                        <div class="input-group items">
                            <div class="col-8 col-md-6 col-lg-8  pt-2">
                                {{Form::select('id',
                                                $preload['produtos'],
                                                $item->produto_id,
                                                ['id'=>'id','class' =>'form-control', 'disabled','placeholder' => 'Selecione o Produto','data-name'=>'id'])}}

                            </div>
                            <div class="col-3 col-md-4 col-lg-2 pt-2">
                                {{Form::text('quantidade',str_replace('.',',',$item->quantidade),['class' => 'form-control float qtd','readonly', 'data-name' => 'quantidade','placeholder' => 'Qtdade'])}}
                            </div>

                            <div class="col-1 col-md-2 col-lg-2 pt-2">
                                {{ Form::checkbox('baixa_estoque['.$item->produto_id.']', '1', true) }}
                            </div>

                        </div>

                        @php
                        $i++;
                        @endphp
                        @endforeach

                    </div>
                    <hr>
                    <h5>Histórico de alteração dos Status</h5>
                    <div class="row" id="">
                        @php
                        $i=0;
                        @endphp
                        @foreach ($data->status as $status_item)
                        @if($i == 0)
                        <div class="input-group items">
                            <div class="col-3 pt-2 bold">
                                {{Form::label('inicio', 'Início')}}
                            </div>
                            <div class="col-3 pt-2 bold">
                                {{Form::label('fim', 'Fim')}}
                            </div>
                            <div class="col-3 pt-2 bold">
                                {{Form::label('status', 'Status')}}
                            </div>
                            <div class="col-3 pt-2 bold">
                                {{Form::label('cadastrado_por', 'Cadastrado por:')}}
                            </div>
                        </div>
                        @endif
                        <div class="input-group items {{ (($i % 2 ) ?:  'bg-light') }}">
                            <div class="col-3 pt-2">
                                {{ (isset($status_item->inicio) ? \Carbon\Carbon::parse($status_item->inicio)->format('d/m/Y H:i:s') : '-') }}
                            </div>
                            <div class="col-3 pt-2">
                                {{ (isset($status_item->fim) ? \Carbon\Carbon::parse($status_item->fim)->format('d/m/Y H:i:s') : 'Atual') }}
                            </div>
                            <div class="col-3 pt-2">
                                {{ $status_item->desc_status }}
                            </div>
                            <div class="col-3 pt-2">
                                {{ $status_item->cadastrado_por }}
                            </div>
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="form-group col-12 pt-2">
                            {{Form::label('status', 'Alterar')}}
                            {{Form::hidden('recebimento_id',$data['id']) }}
                            {{Form::select('status',
                                            $preload['status'],
                                            ((isset($data['status'])) ? $data['status'] : null),
                                            ['id'=>'status','class' =>'form-control','placeholder' => 'Status'])}}
                        </div>
                    </div>
                    <div class="form-group pt-3">
                        {{Form::submit('Salvar',['class'=>'btn btn-success btn-sm'])}}
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
@stop