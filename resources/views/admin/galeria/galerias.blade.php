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
                    </div>
                </div>
                <h3 class="W-100 text-center font-weight-bold pt-2">ISOLAMENTOS</h3>
                <div class="container-fluid">
                    <div class="row p-2 pt-4">

                        <div id="5" class="galeria rounded col-2 p-2 py-5 bg-dark text-center ">ISOLAMENTO 05<br></div>
                        <div id="6" class="galeria rounded col-2 p-2 py-5 bg-dark text-center ">ISOLAMENTO 06<br></div>
                        <div id="7" class="galeria rounded col-2 p-2 py-5 bg-dark text-center ">ISOLAMENTO 07<br></div>
                        <div id="8" class="galeria rounded col-2 p-2 py-5 bg-dark text-center ">ISOLAMENTO 08<br></div>
                        <div id="9" class="galeria rounded col-2 p-2 py-5 bg-dark text-center ">ISOLAMENTO 09<br></div>
                        <div id="10" class="galeria rounded col-2 p-2 py-5 bg-dark text-center ">ISOLAMENTO 10<br></div>
                    </div>
                </div>
                <h3 class="W-100 text-center font-weight-bold pt-2">GALERIAS</h3>
                <div class="container-fluid">
                    <div class="row p-2 pt-4">

                        <div id="1" class="galeria rounded col-2 p-2 py-5 bg-gray text-center">GALERIA 01<br></div>
                        <div class="rounded col-1 p-2 py-5 text-center"></div>
                        <div id="2" class="galeria rounded col-2 p-2 py-5 bg-gray text-center">GALERIA 02<br></div>
                        <div class="rounded col-2 p-2 py-5 text-center"></div>
                        <div id="3" class="galeria rounded col-2 p-2 py-5 bg-gray text-center">GALERIA 03<br></div>
                        <div class="rounded col-1 p-2 py-5 text-center"></div>
                        <div id="4" class="galeria rounded col-2 p-2 py-5 bg-gray text-center">GALERIA 04<br></div>
                    </div>
                </div>
            </div>
        </div>
</section>
@stop

@section('css')
<style>
    .galeria {
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        cursor: pointer;
        border: 2ex solid #FFF;
        height: 20em;


    }


    .galeria:hover {
        background-color: Salmon;
        opacity: 0.8;
        transition: 0.3s;
        color: #92F726;
        transition: .2s ease-in-out transform;
        transform: translate3d(.25em, 0, 0);
    }
</style>
<!-- {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}} -->
@stop

@section('js')
<script>
    $('.galeria').on('click', function() {
        window.location.href = 'galeria/' + this.id;
    });
</script>
@stop