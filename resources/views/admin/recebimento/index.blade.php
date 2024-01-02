@extends('adminlte::page')
@section('title', config('admin.title'))
@section('content_header')
@include('admin.layouts.header')
@stop
@section('content')
<section class="content">
    <div id="app" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row p-2">
                        <div class="col-6">
                            <h3 class="card-title font-weight-bold">{{$params['subtitulo']}}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route($params['main_route'].'.create') }}" class="btn btn-primary btn-xs"><span class="fas fa-plus"></span> Cadastrar novo Recebimento</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    @if(isset($data) && count($data))
                    <table class="table table-hover">
                        <table id="dataTableRecebimentos" class="table table-hover">
                            <thead>
                                <!-- ('credencial')('nome')('data_entrada')('data_hora')('observacao') -->
                                <tr>
                                    <th>Nº</th>
                                    <th>Credencial</th>
                                    <th>Nome Familiar</th>
                                    <th>Nome Preso</th>
                                    <th>Data/Entrada Itens</th>
                                    <th>Operação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item['id']}}</td>
                                    <td>{{ $item['credencial']}}</td>
                                    <td>{{$item['nome']}} - [{{$item['afinidade']}}]</td>
                                    <td>{{ $item['nome_preso']}}</td>
                                    <td>{{ Carbon\Carbon::parse($item->data_hora)->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route($params['main_route'].'.edit', $item['id']) }}" class="btn btn-info btn-xs"><span class="fas fa-edit"></span> Editar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
@section('plugins.Datatables', true)
@stop
@section('js')
<script>
    $(document).ready(function() {
        var table = $('#dataTableRecebimentos').DataTable({
            "language": {
                "decimal": "",
                "emptyTable": "Dados Indisponíveis na Tabela",
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
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        });
    });
</script>
@stop