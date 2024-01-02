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
                            <th>Foto</th>
                            <th>Prontuário</th>
                            <th>Nome</th>
                            <th>Galeria</th>
                            <th>Cubículo</th>
                            <th>Alterar Foto</th>
                            <th>Trocar Cubículo</th>
                            <th>Histórico</th>
                            {{-- <th>#</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <!-- id, titulo, data_hora, importado, usuario, deleted_at, created_at, updated_at -->
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                @if($item->url_foto == "")
                                <img src="{{ asset('storage/fotos/sem-foto.jpg') }}" width="150px" height="auto" alt="{{ $item->prontuario}}">
                                @else
                                <img src="{{ asset('storage/'.$item->url_foto) }}" width="150px" height="auto" alt="{{ $item->prontuario}}">
                                @endif
                            </td>
                            <td>{{ $item->prontuario}}</td>
                            <td>{{ $item->nome}}</td>
                            <td>{{ $item->galeria}}</td>
                            <td>{{ $item->cubiculo}}</td>
                            <td><a href="{{ route($params['main_route'].'.edit', $item->id) }}" type="button" class="btn btn-outline-primary"><i class="fas fa-camera" aria-hidden="true"></i>
                                    Trocar Foto</a></td>
                            <td><a href="#" onclick="abrirModal({{$item->id}})" type="button" class="btn btn-outline-success"><i class="fa fa-cogs" aria-hidden="true"></i>
                                    Alterar Cubiculo</a></td>
                            <td><a href="{{ route($params['main_route'].'.historico', $item->id) }}" type="button" class="btn btn-outline-warning"><i class="fa fa-bars" aria-hidden="true"></i>
                                     </a></td>

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

    <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        <p class="text-primary">ALTERAÇÕES DE ALOJAMENTOS</p>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body container">
                    <div class="row">
                        <div class="col-3 px-3">
                            <img id="foto_preso" width="auto" height="150px" alt="" class="shadow-lg p-1 mb-5 bg-white rounded">
                        </div>
                        <div class="col-9">
                            <h5 class="modal-title w-100 p-2" id="">
                                <span id="preso" class="font-weight-bold"></span>
                            </h5>

                            <h5 class="modal-title w-100 text-uppercase p-2" id="">
                                <span class="font-weight-bold" id="alojamento_atual"></span>
                            </h5>

                        </div>
                        <div class="col-12">
                            <hr class="border-botton">

                            <div class="col-12">
                                <p class="text-primary">
                                <h5>
                                    <p class="modal-title pt-0 text-primary" id="exampleModalLabel">SELECIONE A GALERIA
                                        E CUBÍCULO PARA ALTERAÇÃO</p>
                                </h5>
                                <div class="row">
                                    <div class="col-6">
                                        <select class="form-control" name="galeria_id" id="galeria_id" onchange="getCubiculos()">
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <form id="form-mudanca" action="{{ route('admin.mudanca.store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" id="preso_id" name="preso_id">
                                            <select class="form-control" name="cubiculo_id" id="cubiculo_id" required="" value=''>
                                                <option value="">Selecione a Galeria</option>
                                            </select>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <input id="btn-save" class="btn btn-primary btn-sm" type="submit" value="Mudar Preso">
                    <input id="btn-close" class="btn btn-success btn-sm" data-dismiss="modal" type="submit" value="Fechar">
                </div>




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
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        });

        $('#btn-save').on('click', function() {
            if ($('#cubiculo_id').val() != null && $('#cubiculo_id').val() > 0) {
                $('#form-mudanca').submit();
            } else {

                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Atenção',
                    subtitle: 'Erro',
                    body: 'Selecione um Cubículo',
                    autohide: true,
                    animation: true,
                    close: false,
                });
            }
        });
    });
    // GET CUBÍCULOS

    function getCubiculos() {

        if ($('#galeria_id').val()) {
            $.ajax({
                    url: "http://127.0.0.1/api/cubiculos/" + $('#galeria_id').val(),
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#cubiculo_id').empty();
                        $('#cubiculo_id').append(new Option("Buscando...", ""));

                    }
                })
                .done(function(res) {
                    const result = JSON.parse(JSON.stringify(res));
                    $('#cubiculo_id').empty();
                    $('#cubiculo_id').append(new Option("Selecione", ""));
                    $.each(res, function(key, value) {
                        $('#cubiculo_id').append(new Option(value.numero, value.id));
                    });

                })
                .fail(function(jqXHR, textStatus, msg) {
                    alert(msg);
                });
        } else {
            $('#cubiculo_id').empty();
            $('#cubiculo_id').append(new Option("Selecione a Galeria...", ""));
        }
    }

    // ABRIR MODAL

    function abrirModal(preso_id) {
        getCubiculos();
        $('#preso_id').val(preso_id);
        $('#myModal').on('show.bs.modal', function(e) {
            $('#prontuario').val(preso_id.prontuario);
            $.ajax({
                    url: "http://127.0.0.1/api/presoalojamento/" + preso_id,
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function() {
                        $("#presos").html("Buscando...");
                    }
                })
                .done(function(res) {
                    const result = JSON.parse(JSON.stringify(res));
                    $("#foto_preso").attr("src", '{{ asset("storage") }}/' + result.url_foto);
                    $("#preso").html("NOME: " + result.nome);
                    $("#alojamento_atual").html("Alojamento Atual: " + result.galeria + " - " + result
                        .cubiculo);
                })
                .fail(function(jqXHR, textStatus, msg) {
                    alert(msg);
                });

            // GET GALERIAS
            $.ajax({
                    url: "http://127.0.0.1/api/galerias",
                    type: 'get',
                    dataType: 'json',
                    async: true,
                    beforeSend: function() {
                        $('#galeria_id').empty();
                        $('#galeria_id').append(new Option("Buscando...", ""));
                    }
                })
                .done(function(res) {
                    const result = JSON.parse(JSON.stringify(res));
                    $('#galeria_id').empty();
                    $('#galeria_id').append(new Option("Selecione a Galeria", ""));
                    $.each(res, function(key, value) {
                        $('#galeria_id').append(new Option(value.titulo, value.id));
                    });

                })
                .fail(function(jqXHR, textStatus, msg) {
                    alert(msg);
                });
        });
        $('#myModal').modal('show');
    };
</script>
@stop