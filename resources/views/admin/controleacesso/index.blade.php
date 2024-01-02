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
                            <a href="{{ route($params['main_route'].'.create')}}" class="btn btn-outline-primary btn-xs"><span class="fas fa-plus"></span> Novo Cadastro</a>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">

                    @if(isset($data) && count($data))

                    <table id="dataTablePortaria" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>RG / Placa</th>
                                <th>Nome / Modelo</th>
                                <th>Destino</th>
                                <th>Data Entrada</th>
                                <th>Data Saída</th>
                                <th>Operação</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->desc_tipo}}</td>
                                @if($item->tipo == 1)
                                <td>{{ $item->pessoa[0]->rg}}</td>
                                <td>{{ $item->pessoa[0]->nome_completo}}</td>
                                @else
                                <td>{{ $item->veiculo[0]->placa }}</td>
                                <td>{{ $item->veiculo[0]->modelo}}</td>
                                @endif

                                <td>{{ $item->destino}}</td>
                                <td>{{ Carbon\Carbon::parse($item->data_entrada)->format('d/m/Y H:i:s') }}</td>
                                <td>@if($item->data_saida <> NULL)
                                        {{ Carbon\Carbon::parse($item->data_saida)->format('d/m/Y H:i:s') }}
                                        @endif
                                <td>

                                    <a href="{{ route($params['main_route'].'.show', $item->id) }}" class="btn btn-outline-danger btn-xs"><span class="fas fa-trash"></span> Deletar</a>
                                    @if($item->data_saida == NULL)
                                    <a href="{{ route($params['main_route'].'.exit', $item->id) }}" class="btn btn-outline-success btn-xs"><span class="fas fa-check"></span> Marcar Saída</a>
                                    @endif
                                </td>
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
                <img src="" height="" width="" alt="">
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
        var table = $('#dataTablePortaria').DataTable({
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
                // "aria": {
                //     "sortAscending": ": activate to sort column ascending",
                //     "sortDescending": ": activate to sort column descending"
                // }
            }
        });
    });
</script>

@stop