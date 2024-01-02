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

                    {{
                        Form::model($data,[
                            'route' => [$params['main_route'].'.atribuir',$data->id]
                            ,'class' => 'form'
                            ,'method' => 'put'
                        ])
                    }}
                    <div class="row">

                        <!-- id, preso_id,kit,data_entrada,data_saida -->
                        <div class="form-group col-6 col-md-6 col-lg-6">
                            {{Form::label('prontuario', 'Prontuário')}}
                            {{Form::hidden('preso_id',$data->id) }}
                            {{Form::text('prontuario',$data->prontuario,['class' => 'form-control', 'readonly' => 'readonly'])}}
                        </div>
                        <div class="form-group col-6 col-md-6 col-lg-6">
                            {{Form::label('nome', 'Nome')}}
                            {{Form::text('nome',$data->nome,['class' => 'form-control', 'readonly' => 'readonly'])}}
                            
                        </div>

                        <div class="form-group  col-6 col-md-6 col-lg-6">
                            {{Form::label('kit', 'Número Kit')}}
                            {{Form::text('kit',null,['class' => 'form-control','placeholder' => 'Informe o número do KIT entregue.'])}}
                        </div>

                        <div class="form-group col-12 col-md-12 col-lg-12 ">
                            {{Form::submit('Atribuir',['class'=>'btn btn-danger btn-sm'])}}
                            {{ Form::close() }}
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
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
<link rel="stylesheet" href="{{ asset('js/plugin/jquery-ui/jquery-ui.min.css')}}">
@stop

@section('js')
<script src="{{ asset('js/scripts.js')}}"></script>
<script src="{{ asset('js/plugin/jquery.js')}}"></script>
<script src="{{ asset('js/plugin/jquery.mask.js')}}"></script>
<script src="{{ asset('js/plugin/jquery-ui/jquery-ui.min.js')}}"></script>


<Script>
    const input = document.getElementById("kit").maxLength = "3";

    input.addEventListener("keypress", somenteNumeros);

    function somenteNumeros(e) {

        var charCode = (e.which) ? e.which : e.keyCode

        if (charCode > 31 && (charCode < 48 || charCode > 57))

            e.preventDefault();

    }


</Script>

@stop