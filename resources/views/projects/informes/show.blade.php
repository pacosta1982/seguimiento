@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Informe N° {!! $informe->num_vista !!}</h1>
@stop

@section('content')



      <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Datos del Proyecto</a></li>
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Avance de Obra</a></li>
                  <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Análisis</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                        @include('projects.informes.secciones.datos')
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                      @include('projects.informes.secciones.avance')
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                      @include('projects.informes.secciones.analisis')
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- nav-tabs-custom -->
            </div>

          </div>
@endsection




