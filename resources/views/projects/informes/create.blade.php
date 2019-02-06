@extends('adminlte::page')

@section('title', 'Generar Informe')


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Generar Informe</h3>
            </div>
            
                <form action="{{ action('ReportController@store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                        <input type="text" name="project_id" value="{{$project->id}}" hidden>
                        <input type="text" name="num_vista"  value="{{$informe+1}}" hidden>
                            <div class="form-group">
                                <label for="name">Visita N°</label>
                            <input type="text" name="vista" class="form-control"   disabled value="{{$informe+1}}">
                            </div>
                            <div class="form-group">
                                <label for="task_date">Fecha:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="fecha_visita" required class="form-control date"  placeholder="Ingrese Fecha Visita">
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->
            
                        <div class="box-footer">
                            <button type="submit"  class="btn btn-primary">Enviar</button>
                        </div>
                </form>            
        </div>

    </div>
</div> 

@stop

@section('css')
<link href="{{asset('fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">
<link href="{{asset('bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
@stop

@section('js')
    
    <script src="{{asset('fullcalendar/lib/jquery-ui.custom.min.js')}}"></script>
    <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
    <script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
    <script src="{{asset('fullcalendar/lang-all.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('js/locale-all.js')}}" charset="UTF-8"></script>
    <script src="{{asset('bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>

   


<script src="{{asset('js/bootstrap-datepicker.es.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript">

    $('.date').datepicker({  
       format: 'yyyy-mm-dd',
       autoclose: 'true',
       languaje: 'es'
     });
     
</script> 

@stop