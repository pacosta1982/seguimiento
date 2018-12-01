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
            <h3 class="box-title">Reportes</h3>  
            <a class="btn btn-primary pull-right" href="{!! action('ProjectController@create') !!}"><i class="fa fa-plus-circle"></i> Agregar</a>
        </div>
        <div class="box-body">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                    <th>Informe</th>
                    <th>Fecha</th> 
                    <th class="dt-center">Acciones</th>
                    </tr>
                    </thead>
                <tbody>
                    @foreach($informe as $inf)  
                  <tr>
                    <td>Informe de Obra N° {!! $inf->num_vista !!}</td>
                    
                    <td>{!! $inf->fecha_visita !!}</td>
                    <td class="dt-center">
                        <a href="{!! action('ReportController@show', ['id'=>$inf->project_id,'idvisita'=>$inf->id]) !!}" class="announce"> 
                            <button class="btn btn-primary" type="button"> Ver</button>
                        </a>
                    </td>
                  </tr>
                 @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <th>Informe</th>
                    
                    <th>Fecha</th> 
                    <th class="dt-center">Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
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
