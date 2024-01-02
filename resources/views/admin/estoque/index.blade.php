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
                        <div class="col-12">
                            <h3 class="card-title font-weight-bold">{{$params['subtitulo']}}</h3>
                        </div>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    @if(isset($data) && count($data))
                    <table id="dataTableEstoque" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome Preso</th>
                                <th>Nº Prontuário</th>
                                <th>Nº Kit</th>
                                <th>Produto</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <!-- 'presos.nome', 'produtos.descricao', 'recebimento_itens.quantidade') -->
                                <td>{{ $item['nome']}}</td>
                                <td>{{ $item->prontuario}}</td>
                                <td>{{ $item->kit }}</td>
                                <td>{{ $item['descricao']}}</td>
                                <td>{{ $item['quantidade']}}</td>
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
        var table = $('#dataTableEstoque').DataTable({
            "language": {
                "decimal": ",",
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
                
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        });
    });


 

</script>
@stop