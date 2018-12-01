@extends('adminlte::page')

@section('title', $title)


@section('content_header')
    <h1>{!! $title !!}</h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{url('home')}}"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><strong>{!! $title !!}</strong></li>
    </ol>
@endsection

@section('content')

<div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Rubros</a></li>
          <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
          <li><a href="#tab_3" data-toggle="tab">Fotos</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            @include('projects.informes.secciones.vivienda.uno')
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">

          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_3">
            @include('projects.informes.secciones.vivienda.fotos')
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>

@endsection