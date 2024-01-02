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
                        {{-- <div class="col-6 text-right">
                            <a href="{{ route($params['main_route'].'.create')}}" class="btn btn-primary btn-xs"><span class="fas fa-plus"></span> Novo Cadastro</a>
                    </div> --}}
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive ">

                @if(isset($data) && count($data))
                <table id="dataTablePreso" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fotos SIGEP</th>
                            <th>Fotos PEPG II</th>
                            <th>Prontuário</th>
                            <th>Nome</th>
                            <th>Trocar Foto</th>
                            {{-- <th>#</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <!-- id, titulo, data_hora, importado, usuario, deleted_at, created_at, updated_at -->
                        @foreach ($data as $item)
                        <tr>
                            <td><img src="http://www.spr.depen.pr.gov.br/centralvagas/exibirFoto.jpg?numProntuario={{ $item->prontuario}}&idImagem=1" width="150px" height="auto" alt=""></td>
                            <td><img src="{{ asset('storage/'.$item->url_foto) }}" width="150px" height="auto" alt="{{ $item->prontuario}}"></td>
                            <td>{{ $item->prontuario}}</td>
                            <td>{{ $item->nome}}</td>
                            <td>
                            <a href="{{ route($params['main_route'].'.edit', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-upload" aria-hidden="true"></i> Trocar Foto</a>
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

@section('plugins.Datatables', true)
@stop

@section('js')
<script>
    $(document).ready(function() {
        var table = $('#dataTablePreso').DataTable({
            "language": {
                "decimal": "",
                "emptyTable": "Dados Indisponiveis na Tabela",
                "info": "Mostrando _START_ de _END_ do _TOTAL_ linhas",
                "infoEmpty": "Mostrando 0 linhas",
                "infoFiltered": "(filtrando _MAX_ total de linhas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrando _MENU_ linhas",
                "loadingRecords": "Carregando...",
                "processing": "Processando...",
                "search": "Busca:",
                "zeroRecords": "Nenhum resultado encontrado",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Ultimo",
                    "next": "Proximo",
                    "previous": "Anterior"
                },
            }
        });
    });
</script>
@stop