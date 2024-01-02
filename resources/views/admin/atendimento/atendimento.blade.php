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

                    @if( isset($data))
                        {{
                            Form::model($data,[
                                'route' => [$params['main_route'].'.update',$data->id]
                                ,'class' => 'form'
                                ,'method' => 'put'
                            ])
                        }}
                    @endif
                    @if( $params['tipo']=='audio')

                        <div id="app" class="row">
                            <div class="d-flex w-100 p-2 justify-content-center">
                                <audio-player class="d-flex" src="{{ asset('storage/audio/atendimentos/'.$data["url_audio"]) }}"/></audio-player>
                            </div>
                            <div class="d-flex w-100 p-2 justify-content-center">
                                <responder-atendimento atendimento_id="{{ $data["id"]}}" url="{{ asset('') }}"></responder-atendimento>
                            </div>
                        </div>
                    @else
                        <div id="app" class="row">
                            <div class="d-flex w-100 p-2 justify-content-center">
                                <audio-player class="d-flex" src="{{ asset('storage/audio/atendimentos/'.$data["url_audio"]) }}"/></audio-player>
                            </div>
                            
                            {{--
                                id, titulo, atendimento_online, responsavel, created_at, updated_at
                            --}}       
                            <div class="form-group col-12 col-md-12 col-lg-12">
                                {{Form::hidden('lido', '1')}}
                                {{Form::hidden('respondido', '1')}}
                                {{Form::label('resposta_texto', 'Resposta Texto')}}
                                {{Form::textarea('resposta_texto',null,['class' => 'form-control', 'placeholder' => 'Resposta'])}}
                            </div>
                            <div class="form-group col-12 col-md-12 col-lg-12 pt-2">
                                {{Form::submit('Salvar',['class'=>'btn btn-success btn-sm'])}}
                            </div>  
                        </div>
                            
                    @endif
                    
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
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/scripts.js')}}" ></script>
    <script src="{{ asset('js/app.js')}}" ></script>
@stop