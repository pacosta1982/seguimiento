@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Resumen de Proyecto</h1>
@stop

@section('content')

<div class="box box-solid box-primary">
        <div class="box-header">
          <h3 class="box-title">Proyecto: {!! $project->name !!}</h3>
          <h3 class="box-title pull-right">Programa: {!! $project->program_id?$project->programa->name:"" !!}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
                <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                          <address>
                            <strong>
                            Nombre Proyecto: {!! $project->name !!}<br>
                            Postulantes Elegibles: {!! $project->number_of_households !!}<br>
                            Beneficiarios Elegibles: {{isset($beneficiarios)?$beneficiarios->count():'0'}}<br>
                            Departamento: {!! $project->state_id?$project->state->name:"" !!}<br>
                            Municipio: {!! $project->city_id?$project->city->name:"" !!}<br>
                            Tipo: <br> 
                            SAT: <br>
                            <br>
                            Etapa del Proyecto<br>
                            {{ App\Project::getStatus($project->id)}}
                          </strong>
                          </address>
                          <a href="{!! action('ProjectController@generarviviendas', ['id'=>$project->id]) !!}">
                            <button class="btn btn-primary"  type="button">Generar Viviendas</button>
                          </a>
                          
                        </div>
                        <div class="col-sm-6 invoice-col">
                           <div style="width: 100%; height: 200px;">
                             
                            <br>
                            <i class="fa fa-map-o fa-5x fa-5x"></i><br>Sin Terreno Definido
              
                            
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
        </div><!-- /.box-body -->
      </div>

      <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Informes de Supervición</a></li>
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Documentos</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                        @include('projects.resumen.informes')
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                        @include('projects.resumen.documentos')
                  </div>
                  <!-- /.tab-pane -->

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- nav-tabs-custom -->
            </div>

          </div>
@endsection




