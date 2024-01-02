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

                    <div class="row">
                        <!-- ["descricao","categoria","unidade_medida","controlado_almox",'periodicidade',"observacao"]; -->

                        <div class="form-group col-6 col-md-6 col-lg-6">
                            {{Form::label('descricao', 'Descrição')}}
                            {{Form::text('descricao',null,['class' => 'form-control descricao', 'placeholder' => 'Informe o nome do produto'])}}
                        </div>

                        <div class="form-group col-6 col-md-6 col-lg-6">
                            {{Form::label('categoria', 'Categoria Produto')}}<br>
                            {{Form::select('categoria',
                                $preload['categoria'],
                                ((isset($data->categoria)) ? $data->categoria : null),
                                ['class' => 'form-control']                               
                            )}}
                        </div>

                        <div class="form-group col-6 col-md-6 col-lg-6">
                            {{Form::label('controlado_almox', 'Controla Saldo')}}<br>
                            {{Form::select('controlado_almox',
                                $preload['controlado_almox'],
                                ((isset($data->controlado_almox)) ? $data->controlado_almox : null),
                                ['class' => 'form-control']                               
                            )}}
                        </div>

                        <div class="form-group col-6 col-md-6 col-lg-6">
                            {{Form::label('unidade_medida', 'Unidade de Medida Produto')}}<br>
                            {{Form::select('unidade_medida',
                                $preload['unidade_medida'],
                                ((isset($data->unidade_medida)) ? $data->unidade_medida : null),
                                ['class' => 'form-control']                               
                            )}}
                        </div>

                        <div class="form-group col-6 col-md-6 col-lg-6">
                            {{Form::label('periodicidade', 'Periodicidade (em dias)')}}
                            {{Form::text('periodicidade',null,['class' => 'form-control', 'placeholder' => 'Informe o prazo para substituição do produto'])}}
                        </div>

                        <div class="form-group col-6 col-md-6 col-lg-6">
                            {{Form::label('observacao', 'Observação')}}
                            {{Form::text('observacao',null,['class' => 'form-control', 'placeholder' => 'Observação'])}}
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-12 col-lg-12 ">
                        {{ Form::open(['route' => [$params['main_route'].'.destroy',$data->id],'method' =>'DELETE']) }}
                        {{Form::submit('Deletar',['class'=>'btn btn-danger btn-sm'])}}
                        {{ Form::close() }}
                    </div>

                </div>

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