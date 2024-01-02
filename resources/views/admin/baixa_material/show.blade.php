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

                    <div class="row">
                        {{--
                            id, titulo, tipo, unidade_medida, controla_estoque
                            --}}

                            <div class="form-group col-9 col-md-9 col-lg-9">
                                {{Form::label('produto', 'Produto')}}
                                {{Form::select('produto_id',
                                    $preload['produtos'],
                                    $data->produto_id,
                                    ['id'=>'produto_id','class' =>'form-control','placeholder' => 'Selecione o Produto','disabled', 'data-name'=>'produto_id'])}}
                            </div>

                            <div class="form-group col-3 col-md-3 col-lg-3">
                                {{Form::label('quantidade', 'Quantidade')}}
                                {{Form::text('quantidade',$data->quantidade,['class' => 'form-control quantidade','readonly', 'data-name' => 'quantidade','placeholder' => 'Qtdade'])}}
                            </div>
                            <div class="form-group col-12 col-md-12 col-lg-12">
                                {{Form::label('motivo', 'Motivo')}}
                                {{Form::textarea('motivo',$data->motivo,['class' => 'form-control','rows' => 3, 'readonly', 'placeholder' => 'Motivo'])}}
                            </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-md-12 col-lg-6 d-flex justify-content-start">
                            <a href="{{ route($params['main_route'].'.index') }}" class="btn btn-primary btn-sm"><span class="fas fa-arrow-left"></span>  Voltar</a>
                        </div>
                        <div class="form-group col-12 col-md-12 col-lg-6 d-flex justify-content-end">
                            @role('admin')
                            {{ Form::open(['route' => [$params['main_route'].'.destroy',$data->id],'method' =>'DELETE']) }}
                           
                            {{Form::submit('Deletar',['class'=>'btn btn-danger btn-sm'])}} 
                            
                            {{ Form::close() }}
                            @endrole
                        </div>

                    </div>

                </div>
                <!-- /.card-body -->
              </div>


           </div>
       </div>
    </section>
@stop



@section('js')

@stop
