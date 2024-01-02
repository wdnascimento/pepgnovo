@extends('adminlte::page')
@section('title', config('admin.title'))
@section('content_header')
@include('admin.layouts.header')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop
@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <!-- Init RIBBON Cards -->
          <div class="ribbon-wrapper">
            <div class="ribbon bg-danger">
              PEPGII
            </div>
          </div>
          <!-- End RIBBON Cards -->
          <div class="inner">
            <h3>{{ $data["total_presos"]}}</h3>
            <p>Total Presos Alojados</p>
          </div>
          <div class="icon">
          <i class="ion ion-person-add"></i>
          <i class="fas fa-gavel"></i>
            <i class="ion ion-bag"></i>
            
          </div>
          <a href="#" class="small-box-footer"><i></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-success">
          <!-- Init RIBBON Cards -->
          <div class="ribbon-wrapper">
            <div class="ribbon bg-primary">
              PEPGII
            </div>
          </div>
          <!-- End RIBBON Cards -->
          <div class="inner">
            <h3>{{ $data['preso_kits']}}</h3>
            <p>Quantidade de Kits Atribuídos aos Presos</p>
          </div>
          <div class="icon">
          <i class="ion ion-person-add"></i>
            <i class="fas fa-medkit"></i>
          </div>
          <a href="#" class="small-box-footer"> <i></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <!-- Init RIBBON Cards -->
          <div class="ribbon-wrapper">
            <div class="ribbon bg-success">
              PEPGII
            </div>
          </div>
          <!-- End RIBBON Cards -->
          <div class="inner">
            <h3>{{ $data["id"]}}</h3>
            <p>Quantidade de Sacolas/Sedex Processada na unidade</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
            <i class="fas fa-shopping-bag"></i>
            
          </div>
          <a href="#" class="small-box-footer"> <i></i></a>
        </div>
      </div>
      <!-- ./col -->


      <!-- small box Credenciais -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-secondary">
          <!-- Init RIBBON Cards -->
          <div class="ribbon-wrapper">
            <div class="ribbon bg-danger">
              PEPGII
            </div>
          </div>
          <!-- End RIBBON Cards -->
          <div class="inner">
            <h3>{{ $data['credencial']}}<sup style="font-size: 20px"></sup></h3>
            <p>Credenciais Liberadas para acessar a unidade</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
            <i class="fas fa-id-card"></i>
          </div>
          <a href="#" class="small-box-footer"><i></i></a>
        </div>
      </div>
      <!--  -->


    </div>
  </div>
  <!-- ./col -->
  </div>
  <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop