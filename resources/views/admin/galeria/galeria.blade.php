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
                            <h3 class="card-title">{{ $params['subtitulo'] }}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route($params['main_route'].'.galerias')}}" class="btn btn-primary btn-xs"><span class="fas fa-arrow-left"></span> Voltar</a>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-5 ">
                    <div class="container-fluid">
                        <!-- <h1 class="w-100 text-center">{{ $data['titulo'] }}</h1> -->
                        <div class="row px-5 justify-content-between bg-dark py-5">
                            @foreach($data["unidade"] as $unidade)
                            <div class="col-5 p-0 m-2 cursor bg-white" id="x-{{ $unidade['numero'] }}">
                                <div class="row ">
                                    <div class="col-10 p-3 font-weight-bold">{{ $unidade["numero"] }}</div>
                                    <div class="col-2 p-3 bg-primary text-center font-weight-bold">
                                        <span class="text-center">0</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-12 py-4">
                            <h3 class="pt-4 p-3 text-center">Total de presos alojados: {{ $data['total_presos']}} presos</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>


        </div>
    </div>
    <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Presos do Cubículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="presos" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>


            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<style>
    .cursor {
        cursor: pointer;
    }

    .cursor:hover {
        background-color: lightslategrey;
        opacity: 0.8;
        transition: 0.3s;
        color: #ffffff;
    }
</style>
{{-- <link rel="stylesheet" href="{{asset('css/admin_custom.css') }}"> --}}
@stop

@section('js')
<script>
    $(document).ready(function() {
        @if(isset($data) && $data["unidade"] != NULL)
        @foreach($data["unidade"] as $unidade)
        $('#x-{{$unidade["numero"]}} span').html("{{count($unidade['presos'])}}");
        $('#x-{{$unidade["numero"]}}').on('click', function() {
            $('#exampleModalLabel').html("Presos do Cubículo {{ $unidade['numero'] }}");
            $('#myModal').data('id', '{{$unidade["id"]}}');
            $('#myModal').modal('show');
        });
        @endforeach
        @endif
    });

    $('#myModal').on('show.bs.modal', function(e) {
        getPresoPorCubículo($('#myModal').data('id'));
    });

    function getPresoPorCubículo(id) {
        $.ajax({
                url: "{{route('admin.preso.por_cubiculo') }}",
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                beforeSend: function() {
                    $("#presos").html("Buscando...");
                }
            })
            .done(function(res) {
                const result = JSON.parse(JSON.stringify(res));
                if (result) {
                    var html = `<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Prontuário</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Artigos</th>
                                </tr>
                            </thead>
                            <tbody>`;

                    result[0].presos.forEach(function(i, v) {
                        html += `
                                <tr>
                                    <th scope="row">
                                        <img height="100px" width="auto" src="`
                                        + ((i.url_foto === null) ? '{{ asset("storage/fotos/sem-foto.jpg") }}' : '{{ asset("storage/") }}/'+i.url_foto) + `">
                                    </th>
                                    <td> ` + i.prontuario + `</td>
                                    <td> ` + i.nome + `</td>
                                    <td> ` + i.artigos + `</td>
                                </tr>`;
                        console.log(i);
                    });

                    html += `</tbody>
                                </table>`;

                }
                $("#presos").html(html);
            })
            .fail(function(jqXHR, textStatus, msg) {
                alert(msg);
            });
    }
</script>
@stop