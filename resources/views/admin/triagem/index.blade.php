@extends('adminlte::page')
@section('title', config('admin.title'))
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content_header')
@include('admin.layouts.header')
@stop
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row p-2">
                        <div class="col-12 ">
                            <h3 class="card-title font-weight-bold">{{$params['subtitulo']}}</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    @if(isset($data) && count($data))
                    <table class="table table-hover">
                        <table id="dataTableTriagem" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Data</th>
                                    <th>Nome Preso</th>
                                    <th>Status</th>
                                    <th>Operação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id}}</td>
                                    <td>{{ Carbon\Carbon::parse($item->data_recebimento)->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $item->nome_preso}}</td>
                                    <td><span class="status_{{ $item->status }} p-1 rounded">{{ $item->desc_status}}</span></td>
                                    <td>
                                        @if($item->status != 3)
                                        <a href="{{ route($params['main_route'].'.edit', $item->id) }}" class="btn btn-info btn-xs"><span class="fas fa-edit"></span> Mudar Status</a>
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
                    </table>
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
<script src="{{ asset('js/ajax.js')}}"></script>
<script>
    $(document).ready(function() {
        var table = $('#dataTableTriagem').DataTable({
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