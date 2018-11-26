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

<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Ultimos Proyectos</h3>  
            <a class="btn btn-primary pull-right" href="{!! action('ProjectController@create') !!}"><i class="fa fa-plus-circle"></i> Agregar</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Proyecto</th>
                      <th>Programa</th>
                      <th>Departamento</th>
                      <th class="text-center">Etapa</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                <tbody>
                    @foreach($projects as $project)  
                  <tr>
                    <td><a href="l">{!! $project->id !!}</a></td>
                    <td>{!! $project->name !!}</td>
                    <td></td>
                    <td></td>
                    <td class="text-center">
                        <span class="label label-success">
                        {{ App\Project::getStatus($project->id)  }}
                        </span>
                    </td>
                    <td class="dt-center">
                        <div class="dropdown">
                            <a href="#/" data-toggle="dropdown"     ><i class="fa fa-fw fa-list-ul"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="">Ver</a></li>
                                <li><a href="{!! action('ProjectController@edit', ['id'=>$project->id]) !!}">Editar</a></li>
                                <li><a href="{!! action('ProjectController@files', ['id'=>$project->id]) !!}">Documentos</a></li>
                                <li><a href="">Propiedades</a></li>
                            </ul>
                        </div>
                    </td>
                  </tr>
                 @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                      <th>Proyecto</th>
                      <th>Programa</th>
                      <th>Departamento</th>
                      <th class="text-center">Etapa</th>
                      <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
      </div>


@stop
@section('css')
<style>
	
    th.dt-center, td.dt-center 
    { 
        text-align: center;
        
    }
    td.dt-center i{
        color: black;
    }


</style>


@stop

@section('js')
    
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script> 
@stop
