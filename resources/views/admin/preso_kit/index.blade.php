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
                            <!-- <a href="{{ route($params['main_route'].'.create')}}" class="btn btn-outline-primary btn-xs"><span class="fas fa-plus"></span> Novo Cadastro</a> -->
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">

                    @if(isset($data) && count($data))
                    <table id="dataTablePresoKit" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Prontuário</th>
                                <th>Nome</th>
                                <th>Cubículo</th>
                                <th>Kit Atual</th>
                                <th>Operação</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <!-- id, titulo, data_hora, importado, usuario, deleted_at, created_at, updated_at -->
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->prontuario}}</td>
                                <td>{{ $item->nome}}</td>
                                <td>{{ $item->galeria }} / {{ $item->numero }}</td>
                                <td>{{ $item->kit }}</td>
                                
                                <td>
                                    @if($item->id != NULL)
                                        <a href="{{ route($params['main_route'].'.trocarKit', $item->id ) }}" class="btn btn-danger btn-xs"><span class="fas fa-edit"></span> Liberar Kit</a>
                                    @else
                                        <a href="{{ route($params['main_route'].'.atribuirKit',['preso_id' => $item->preso_id] ) }}" class="btn btn-primary btn-xs"><span class="fas fa-edit"></span> Atribuir Kit</a>
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
        var table = $('#dataTablePresoKit').DataTable({
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